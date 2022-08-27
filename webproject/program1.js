
let carts=document.querySelectorAll('.add-cart');
let products=[
    {
        name:'Chanel White Caviar',
        tag:'product1',
        price:7500,
        inCart:0
    },
    {
        name:'Chanel Pink Calfskin',
        tag:'product2',
        price:8000,
        inCart:0
    },
    {
        name:'Coco Mademoiselle',
        tag:'product3',
        price:6500,
        inCart:0
    },
    {
        name:'BVLGARI set Jewelry',
        tag:'product4',
        price:5000,
        inCart:0
    },
    {
        name:'Gucci.s Padlock Bag',
        tag:'product5',
        price:4800,
        inCart:0
    },
    {
        name:'Gucci.s leather Belt ',
        tag:'product6',
        price:1500,
        inCart:0
    },
    {
        name:'The Layered necklace',
        tag:'product7',
        price:9800,
        inCart:0
    },
    {
        name:'The Gems Blue  Ring  ',
        tag:'product8',
        price:8700,
        inCart:0
    },
    {
        name:'Amethyst Earing set',
        tag:'product9',
        price:6600,
        inCart:0
    },

    {
        name:'Exotic Bloom Necklace',
        tag:'product10',
        price:7400,
        inCart:0
    },
    {
        name:'Shoulder Ball Gown  ',
        tag:'product11',
        price:6200,
        inCart:0
    },
    {
        name:'Luxury Feather Gown',
        tag:'product12',
        price:7800,
        inCart:0
    },
    {
        name:'La D de Dior Satine',
        tag:'product13',
        price:5800,
        inCart:0
    },
    {
        name:'Sauvage Eau Parfum',
        tag:'product14',
        price:7000,
        inCart:0
    },
    {
        name:'Double leaf Chain',
        tag:'product15',
        price:8800,
        inCart:0
    },
    {
        name:'Cruise custom Earings',
        tag:'product16',
        price:9000,
        inCart:0
    },
    {
        name:'YellowChimes Exclusve',
        tag:'product17',
        price:5000,
        inCart:0
    },
    {
        name:'Sterling silver Bracelet',
        tag:'product18',
        price:4000,
        inCart:0
    }
];

for(let i=0;i<carts.length;i++){
    carts[i].addEventListener('click', () => {
        cartNumbers(products[i]);
        totalCost(products[i]);
        
    })
   
}
function onLoadCartNumbers(){ //load the number of items selected
    let productNumbers=localStorage.getItem('cartNumbers');
    if(productNumbers){
        document.querySelector('.cart span').textContent=productNumbers;  
    }


}
function cartNumbers(products){ //increase the number of products 
    let productNumbers=localStorage.getItem('cartNumbers');
   
    productNumbers=parseInt(productNumbers);
    if(productNumbers){
    localStorage.setItem('cartNumbers',productNumbers + 1);
    document.querySelector('.cart span').textContent=productNumbers + 1;

}else{
    localStorage.setItem('cartNumbers', 1);
    document.querySelector('.cart span').textContent = 1;

}

setItems(products);
}
function setItems(products){ //set product items in the local storage
    let cartItems=localStorage.getItem('productsInCart');
    cartItems=JSON.parse(cartItems);

    if(cartItems!=null){

        if(cartItems[products.tag] == undefined){
            cartItems={
                ...cartItems,
                [products.tag]: products
            }
        }
        cartItems[products.tag].inCart +=1;
    }else{
        products.inCart =1;
        cartItems ={
            [products.tag]:products
        }
    }

  
    localStorage.setItem("productsInCart",JSON.stringify(cartItems));

}


function totalCost(products){
  
  let cartCost=localStorage.getItem('totalCost');
 
  if(cartCost != null){
    cartCost = parseInt(cartCost);
    localStorage.setItem("totalCost",cartCost + products.price);  


  }else{
  localStorage.setItem("totalCost",products.price);
}

}
function displayCart(){
    let cartItems=localStorage.getItem('productsInCart');
    cartItems = JSON.parse(cartItems);
    let productContainer=document.querySelector('.products');
    
    let cartCost=localStorage.getItem('totalCost');
    if(cartItems && productContainer){
        productContainer.innerHTML='';
        Object.values(cartItems).map(item =>{
            productContainer.innerHTML +=`
            <div class="product">
           
               <ion-icon name="close-circle"></ion-icon>
                <img src="${item.tag}.jpg"></img>
                <span>
                    ${item.name}
                </span>
            </div>
          
            <div class="price">
                ${item.price}
            </div>

          
            <div class="quantity">
            <ion-icon name="arrow-back-circle"></ion-icon>
   
                <span>${item.inCart}</span>
                <ion-icon name="arrow-forward-circle"></ion-icon>
             </div>
                <div class="total" name="totalCost">
                    $${item.inCart *item.price},00
  
               </div>
               
               
           `;
        });
        productContainer.innerHTML +=`
        <div class="basketTotalContainer">
            <h4 class="basketTotalTitle">
                
             Total Amount : 
            </h4>
            
            <h4 class="basketTotal">
                $${cartCost},00

                
<br><br>
 <p><button type="Submit" class="remove12"onclick="clearLocalStorage()" > Remove all the Items</button></p>
            
            `
       
    }
    }
  
    function clearLocalStorage(){
        localStorage.clear();
        alert("All the items in the cart will be removed");
        window.open('index2.html');
      
    }




 onLoadCartNumbers();
displayCart();