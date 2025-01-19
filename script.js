const next = document.querySelector('.next')
const prev = document.querySelector('.prev')
const comment = document.querySelector('#list-comment')
const commentItem = document.querySelectorAll('#list-comment .item')
var translateY = 0
var count = commentItem.length

const wappers = document.querySelector(".to-bottom")
if(wappers){
    wappers.addEventListener("click", function(){
        document.querySelector(".box-left button").classList.toggle("activeA")
    })
}

next.addEventListener('click', function (event){
    event.preventDefault()
    if(count == 1){
        //Xem bình luận
        return false
    }
    translateY += -400
    comment.style.transform = `translateY(${translateY}px)`
    count--
})
prev.addEventListener('click', function (event){
    event.preventDefault()
    if(count == 4){
        //Xem bình luận
        return false
    }
    translateY += 400
    comment.style.transform = `translateY(${translateY}px)`
    count++
})

document.addEventListener("DOMContentLoaded", function() {
    const listPages = document.querySelectorAll(".list-page .item a");
    const listProducts = document.getElementById("list-products");
    
    listPages.forEach(function(page) {
        page.addEventListener("click", function(event) {
            event.preventDefault();
            const pageNumber = parseInt(page.textContent);
            const itemsPerPage = 4; // Số lượng sản phẩm hiển thị trên mỗi trang
            const startIndex = (pageNumber - 1) * itemsPerPage;
            const endIndex = pageNumber * itemsPerPage;
            
            // Ẩn tất cả các sản phẩm
            const allItems = listProducts.querySelectorAll(".item");
            allItems.forEach(function(item) {
                item.style.display = "none";
            });
            
            // Hiển thị các sản phẩm ứng với trang được chọn
            for (let i = startIndex; i < endIndex && i < allItems.length; i++) {
                allItems[i].style.display = "block";
            }
        });
    });
});

document.getElementById('searchInput').addEventListener('input', function() {
    const searchValue = this.value.trim().toLowerCase();
    const items = document.querySelectorAll('.item');
  
    items.forEach(function(item) {
      const text = item.textContent.trim().toLowerCase();
      if (text.startsWith(searchValue)) {
        item.style.display = 'block';
      } else {
        item.style.display = 'block';
      }
    });
  });
