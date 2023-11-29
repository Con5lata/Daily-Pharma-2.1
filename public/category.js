const categoryItems = document.querySelectorAll('.category-item');
const categoryContents = document.querySelectorAll('.category-content');

// Function to handle category item click
function handleCategoryClick(event) {
  const selectedCategory = event.target.dataset.category;

  // Toggle active class on the clicked item
  categoryItems.forEach((item) => {
    item.classList.remove('active');
  });
  event.target.classList.add('active');

  // Toggle active class on the corresponding category content
  categoryContents.forEach((content) => {
    content.classList.remove('show');
    if (content.id === selectedCategory) {
      content.classList.add('show');
    }
  });
}

// Add event listeners to category items
categoryItems.forEach((item) => {
  item.addEventListener('click', handleCategoryClick);
});