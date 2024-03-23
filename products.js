import productsData from "./productsData.js";

const productsTableEl = document.getElementById("products-table");

productsData.forEach((product) => {
  const newRow = document.createElement("tr");

  newRow.innerHTML = `
        <th scope="row">${product.id}</th>
        <td>${product.productName}</td>
        <td>${product.price}</td>
        <td>${product.stocks}</td>
        <td>${product.category}</td>
        <td>${product.stall}</td>
        <td>${product.lastModified}</td>
        <td>
            <a href="#">View more</a>
        </td>
    `;

  productsTableEl.appendChild(newRow);
});
