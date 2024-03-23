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
        <td class="d-flex align-items-center justify-content-center  gap-2 ">
          <button class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-pencil"></i>
          </button>
          <button class="btn btn-outline-secondary  btn-sm">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
    `;

  productsTableEl.appendChild(newRow);
});
