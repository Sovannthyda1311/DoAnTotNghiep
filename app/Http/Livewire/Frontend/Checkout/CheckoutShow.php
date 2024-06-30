<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Mail\PlaceOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname, $email, $phone, $city, $district, $ward, $address, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];
    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';

        $codOrder = $this->placeOrder();
        if ($codOrder) {
            Cart::where('user_id', auth()->user()->id)->delete();

            try{

                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                //success
            }catch(\Exception $e){
                //something went wrong
            }

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }


    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'address' => 'required|string|max:500',
        ];
    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'thyda-' . mt_rand(1000000000, 9999999999),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'district' => $this->district,
            'ward' => $this->ward,
            'address' => $this->address,
            'status_message' => 'Pending',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);

        foreach ($this->carts as $cartItem) {
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'product_size_id' => $cartItem->product_size_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

            if ($cartItem->product_color_id != null) {
                $productColor = $cartItem->productColor;
                if ($productColor) {
                    $productColor->decrement('quantity', $cartItem->quantity);
                }
            }

            if ($cartItem->product_size_id != null) {
                $productSize = $cartItem->productSize;
                if ($productSize) {
                    $productSize->decrement('quantity', $cartItem->quantity);
                }
            }

            $cartItem->product->decrement('quantity', $cartItem->quantity);
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder)
        {
            Cart::where('user_id', auth()->user()->id)->delete();

            try{

                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                //success
            }catch(\Exception $e){
                //something went wrong
            }

            session()->flash('message','Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Place Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 404
            ]);
        }


    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach($this->carts as $cartItem)
        {
           $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $userDetail = auth()->user()->userDetail;

        if ($userDetail) {
            $this->phone = $userDetail->phone ?? null;
            $this->city = $userDetail->city ?? null;
            $this->district = $userDetail->district ?? null;
            $this->ward = $userDetail->ward ?? null;
            $this->address = $userDetail->address ?? null;
        } else {
            // Handle the case when userDetail is null
            $this->phone = null;
            $this->city = null;
            $this->district = null;
            $this->ward = null;
            $this->address = null;
        }

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
