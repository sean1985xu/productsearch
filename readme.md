
## Category Search

This project is used for a code test to let user search from a json file;

- homepage '/' will redirect to the input category page 'product/category-input';
- category input page 'product/category-input' is the page for user to input category value and submit, when finish submit, user will get into category search result page 'product/category-search';
- category search result page 'product/category-search' is the page to display subcategory name and total number inside the input category, user can click subcategory name to get into the subcategory search product page 'product/subcategory-search/{category}/{subcategory}';
- subcategory search products page 'product/subcategory-search/{category}/{subcategory}' is the page to display all the product inside the input category and subcategory with pagination;

Main Function is inside app/Http/Controllers/ProductController;
Main Views are inside resources/views folder;
