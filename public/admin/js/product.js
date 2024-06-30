var subcategories = {!! json_encode($subcategories->groupBy('category_id')) !!};

function updateSubcategories() {
    var categoryId = document.getElementById('category').value;
    var subcategoryDropdown = document.getElementById('subcategory');
    subcategoryDropdown.innerHTML = '';

    // Filter the subcategories based on the selected category
    var filteredSubcategories = subcategories[categoryId];
    filteredSubcategories.forEach(function(subcategory) {
        var option = document.createElement('option');
        option.value = subcategory.id;
        option.textContent = subcategory.name;
        subcategoryDropdown.appendChild(option);
    });
}
