document.getElementById('productCategory').addEventListener('change', function(){
    const category = this.value;
    const selectProductName = document.getElementById('productName');

    selectProductName.innerHTML = '<option value="" disabled selected>Select Product</option>';

    const products = {
        'Hard-Boiled Candy' : ['Lemon Sherbet', 'Humbug'],
        'Gummy Candy': ['Cola Bottle'], 
        'Lollipops' : ['Watermelon'],
        'Nerds' : ['Grape and Strawberry'],
        'Sour Candy' : ['Rainbow Twists']
    };

    //only displays the options that fall within the selected product category 
    if (products[category]) {
        products[category].forEach(function(product) {
            const option = document.createElement('option');
            option.value = product;
            option.text = product;
            selectProductName.add(option);
        });
    }
});
