const sizes = document.querySelectorAll('.size');
const colors = document.querySelectorAll('.color');
const shoes = document.querySelectorAll('.shoe');
const gradients = document.querySelectorAll('.gradient');
const shoeBg = document.querySelector('.shoeBackground');

let prevColor = "blue";
let animationEnd = true;

function changeSize(){
    sizes.forEach(size => size.classList.remove('active'));
    this.classList.add('active');
}

function changeColor(){
    if(!animationEnd) return;
    let primary = this.getAttribute('primary');
    let color = this.getAttribute('color');
    let shoe = document.querySelector(`.shoe[color="${color}"]`);
    let gradient = document.querySelector(`.gradient[color="${color}"]`);
    let prevGradient = document.querySelector(`.gradient[color="${prevColor}"]`);

    if(color == prevColor) return;

    colors.forEach(c => c.classList.remove('active'));
    this.classList.add('active');

    document.documentElement.style.setProperty('--primary', primary);
    
    shoes.forEach(s => s.classList.remove('show'));
    shoe.classList.add('show');

    gradients.forEach(g => g.classList.remove('first', 'second'));
    gradient.classList.add('first');
    prevGradient.classList.add('second');

    prevColor = color;
    animationEnd = false;

    gradient.addEventListener('animationend', () => {
        animationEnd = true;
    })
}

sizes.forEach(size => size.addEventListener('click', changeSize));
colors.forEach(c => c.addEventListener('click', changeColor));

let x = window.matchMedia("(max-width: 1000px)");

function changeHeight(){
    if(x.matches){
        let shoeHeight = shoes[0].offsetHeight;
        shoeBg.style.height = `${shoeHeight * 0.9}px`;
    }
    else{
        shoeBg.style.height = "475px";
    }
}

changeHeight();



window.addEventListener('resize', changeHeight);

//product details javascript//


 // Sample array of products (replace this with your data from backend/API)
 const products = [
    {
      name: 'Product 1',
      price: '$19.99',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    },
    {
      name: 'Product 2',
      price: '$29.99',
      description: 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
    },
    // Add more products as needed
  ];

  // Function to render product details
  function renderProductDetails(product) {
    const productDetailsContainer = document.getElementById('productDetails');

    // Create HTML elements for each detail
    const productName = document.createElement('h2');
    productName.textContent = product.name;

    const productPrice = document.createElement('p');
    productPrice.textContent = `Price: ${product.price}`;

    const productDescription = document.createElement('p');
    productDescription.textContent = product.description;

    // Append elements to the container
    productDetailsContainer.appendChild(productName);
    productDetailsContainer.appendChild(productPrice);
    productDetailsContainer.appendChild(productDescription);

    // You can add more details and formatting as needed
  }

  // Iterate through the array and render details for each product
  for (const product of products) {
    renderProductDetails(product);

    // Add a separator (optional) between product details
    const separator = document.createElement('hr');
    document.getElementById('productDetails').appendChild(separator);
  }