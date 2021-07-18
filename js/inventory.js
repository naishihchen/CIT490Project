'use strict' 
 
 // Get a list of products in inventory based on the itemId 
 let itemList = document.querySelector("#itemList"); 
 itemList.addEventListener("change", function () { 
  let itemId = itemList.value; 
  console.log(`itemId is: ${itemId}`); 
  let itemIdURL = "/items/index.php?action=getProductItems&itemId=" + itemId;
  fetch(itemIdURL)
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) {
   console.log(data); 
   buildProductList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message);
  }) 
 })

 // Build product items into HTML table components and inject into DOM 
function buildProductList(data) { 
    let productDisplay = document.getElementById("productDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all products in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.prodId + ", " + element.prodName); 
     dataTable += `<tr><td>${element.prodName}</td>`; 
     dataTable += `<td><a href='/items?action=mod&prodId=${element.prodId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/items?action=del&prodId=${element.prodId}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    productDisplay.innerHTML = dataTable; 
   }