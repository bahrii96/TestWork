(function ($) {
  $(document).ready(function () {
    let clearFieldsButton = document.getElementById("clear_fields_button");

    if (clearFieldsButton) {
      clearFieldsButton.addEventListener("click", function () {
        document.getElementById("product_title").value = "";
        document.getElementById("product_price").value = "";
        document.getElementById("custom_image").value = "";
        document.getElementById("custom_date").value = "";
        document.getElementById("custom_type").selectedIndex = 0;
      });
    }

    let clearImageFieldButton = document.getElementById("clear_image_field_button");

    if (clearImageFieldButton) {
      clearImageFieldButton.addEventListener("click", function () {
        document.getElementById("custom_image").value = "";
      });
    }
  });
})(jQuery);
