const NewsContainer = document.getElementById("news-container");

const URL =
  "https://newsapi.org/v2/everything?q=Tesla&language=en&sortBy=publishedAt&pageSize=30&apiKey=ac62a6e95cd34410a7d49cae52dfea62";

const getNews = async () => {
  const response = await fetch(URL);
  const result = await response.json();
  const data = await result.articles;
  const shortData = data
    .filter((news) => news.title !== "[Removed]" && news.source.id)
    .slice(0, 3);
  console.log(shortData);
  console.log(data);
  if (NewsContainer.classList.contains("latest-updates-container")) {
    const newsList = `<div class="latest-updates-list flex gap-5 mx-10">
                    ${shortData.map((news) => {
                      return `
                        <div class="update-1 flex-1 duration-300 hover:scale-105 cursor-pointer neuromorphism overflow-hidden rounded-xl flex flex-col bg-slate-200 h-max">
                        <div class="update-image flex items-center justify-center">
                            <img src="${
                              news.urlToImage
                            }" alt="" class="max-h-[10rem] max-w-full">
                        </div>
                        <div class="flex flex-col p-4 gap-4">
                            <h2 class="text-lg">${
                              news.title.length > 90
                                ? news.title.slice(0, 90) + "..."
                                : news.title
                            }</h2>
                            <div class="flex justify-between items-center">
                                <span>By <span class="font-bold">${
                                  news.author
                                }</span></span>
                                <span class="text-sm text-gray-500">${
                                  parseFloat(new Date().getHours()) -
                                  parseInt(
                                    new Date(
                                      news.publishedAt
                                    ).toLocaleTimeString("en-us", {
                                      hour: "numeric",
                                    })
                                  )
                                } hours ago</span>
                            </div>
                            <p class="text-slate-600 text-sm">${
                              news.description
                            }</p>
                            <a href="${
                              news.url
                            }" target="_blank" class="text-blue-500 text-right">
                                Read More
                            </a>
                        </div>
                    </div>`;
                    })}
                </div>`;
    NewsContainer.innerHTML = newsList;
  } else {
    const newsList = `
     <div class="w-full flex flex-col gap-10">
                ${data
                  .filter((news) => news.title !== "[Removed]")
                  .map((news) => {
                    return `
                    <div class="flex gap-5 px-6 items-center neuromorphism rounded-xl overflow-hidden">
                    <div class="flex-[0.4] flex items-center justify-center"><img src="${
                      news.urlToImage
                    }" alt="Not Found" class="rounded-xl"></div>
                    <div class="flex-[0.6] flex flex-col gap-4 py-5">
                        <h2 class="text-3xl font-bold text-slate-800">${
                          news.title
                        }</h2>
                        <p class="font-semibold text-slate-600 text-lg">Published on ${new Date(
                          news.publishedAt
                        ).toLocaleDateString("en-us", {
                          month: "short",
                          day: "2-digit",
                          year: "numeric",
                        })}</p>
                        <p class="text-base text-slate-700">${
                          news.description
                        }</p>
                        <a href="${
                          news.url
                        }" target="_blank" class="text-slate-100 px-3 py-1 w-max bg-blue-500 rounded-md">Read More...</a>
                    </div>
                </div>`;
                  })
                  .join("")}
            </div>
  `;
    NewsContainer.innerHTML = newsList;
  }
};

getNews();
