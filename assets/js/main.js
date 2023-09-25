const CarListContainer = document.getElementById("car-list");
const Loader = document.querySelector(".loader");

const noDataStatement = {
  carList: "No Cars Available with specified filters",
  favoriteList: "No car marked as favorite",
  brandList: "No Cars Available for this Brand Currently",
};

const getCarList = async (endPoint, noData, filter_value = 100000000) => {
  var carList = [];
  const response = await fetch(endPoint);
  const result = await response.json();
  console.log(result);
  carList = result;
  var filteredCardList = carList.filter(
    (car) => car.price < filter_value * 100000
  );
  const carListData =
    filteredCardList.length === 0
      ? `<div class='text-lg text-center bg-slate-400 px-5 py-3 border border-slate-500 mx-auto w'>${noData}</div>`
      : `
    <div class="grid grid-cols-2 gap-10 w-full">
    ${filteredCardList
      .map((item) => {
        return `
        <div class="flex flex-col border rounded-md overflow-hidden shadow-[0_0_20px_#22222260] border-blue-300 justify-around">
                        <div class="car-image">
                            <img src="${item.image_url}" alt="">
                        </div>
                        <div class="py-3 px-6 flex flex-col gap-1">
                            <div class="flex text-lg justify-between items-center">
                                <span class="text-slate-800 text-3xl font-bold">${
                                  item.make
                                } ${item.model}</span>
                                <span class="font-light text-gray-600">${new Date(
                                  item.month
                                ).toLocaleDateString("en-us", {
                                  month: "short",
                                })} ${item.year}</span>
                            </div>
                            <p class="px-2 text-blue-500">${item.type}</p>
                            <p class="text-2xl text-yellow-500 border border-yellow-500 w-max px-2 py-1">Rs.${
                              item.price > 10000000
                                ? `${item.price / 10000000} Cr`
                                : `${item.price / 100000} Lakh`
                            } onwards</p>
                            <a href="./car.php?car_id=${
                              item.car_id
                            }" class="btn-animate px-4 w-max my-5 py-2 border border-blue-500 bg-slate-50 text-blue-500 "><span>Show Details</span></a>
                        </div>
                    </div>
      `;
      })
      .join("")}
    </div>
  `;
  CarListContainer.innerHTML = carListData;
};

if (CarListContainer.classList.contains("favorites")) {
  getCarList(
    "api/data-endpoint-0x400/get-favorites.php",
    noDataStatement["favoriteList"]
  );
} else if (CarListContainer.classList.contains("brand-wise")) {
  let brandName = CarListContainer.dataset.brand;
  getCarList(
    `api/data-endpoint-0x400/brand-cars.php/?brand=${brandName}`,
    noDataStatement["brandList"]
  );
} else {
  getCarList("api/data-endpoint-0x400/data.php", noDataStatement["carList"]);
}

function getFilteredCarList(element) {
  getCarList(
    "api/data-endpoint-0x400/data.php",
    noDataStatement["carList"],
    element.dataset.filter_value
  );
}
