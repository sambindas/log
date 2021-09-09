// navigation among pages
let pageCount = 2;
let next = document.querySelector("#next");
let prev = document.querySelector("#prev");
let indicators = Array.from(document.querySelectorAll(".tfooter .indicator"));
indicators = Array.from(indicators)
let currentPage;
let pageLimit = 10;



// go to the next page on click of last
next.addEventListener("click", e => {
  pageCount == pageLimit - 3 ? (pageCount = 1) : pageCount++;
  indicators[indicators.length - 1].textContent = pageCount;
  currentPage = pageCount;
  indicators.forEach(link => {
    link.textContent = currentPage++;
    if (link.textContent == pageCount) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
 
});

// go to the previous page on click of last
prev.addEventListener("click", e => {
  pageCount === 1 ? (pageCount = pageLimit - 3) : pageCount--;
  indicators[0].textContent = pageCount;
  currentPage = pageCount;
  currentPage++;
  for (let index = 1; index < indicators.length; index++) {
    val = indicators[index].textContent;
    indicators[index].textContent = currentPage++;
  }
  indicators.forEach(link => {
    if (link.textContent == pageCount) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
  
});

// navigate to page clicked
indicators.forEach(link =>
  link.addEventListener("click", e => {
    indicators.forEach(btn => btn.classList.remove("active"));
    e.target.classList.add("active");
    pageCount = e.target.textContent;
  })
);
