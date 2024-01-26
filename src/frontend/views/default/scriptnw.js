var dragWithoutZoom = false;
var iframeHeight;
var remainingTimeThreadNumber;

var gotIt = true;

var previewTemplate = "";
var maxFile;
var imageCount;
var doRemoveExisting = true;
var uploadedCount = 0;
var values;
var fileName;
var closeClick = false;

function addAdonByModalPrd() {
  addAdonByModalPrdEvent();
  var pId = "";
  $(".clckEventAddon").each(function () {
    if ($(this).is(":checked")) {
      pId += $(this).val() + ",";
    }
  });
  var deliveryZoneId = $("#deliveryZoneId").val();
  var catUrl = $("#giftBoxUrlId").val();
  var adonUrl = $("#addAddonUrl").val();
  var checkUrl = $("#checkUrlId").val();
  var uhstknValue = $(".uhstknValue").val();
  if (actionValue === "AddtoCart") {
    if (pId === "") {
      location.href = catUrl;
    } else {
      $.ajax({
        type: "POST",
        url: adonUrl,
        data: {
          productId: pId.toString(),
          deliveryZoneId: deliveryZoneId,
          adobeExclude: "",
        },
        success: function (response) {
          if (response.success) {
            location.href = catUrl;
          }
        },
        error: function () {},
      });
    }
  } else {
    if (pId === "") {
      location.href = checkUrl;
    } else {
      $.ajax({
        type: "POST",
        url: adonUrl,
        data: {
          productId: pId.toString(),
          deliveryZoneId: deliveryZoneId,
          adobeExclude: "",
        },
        success: function (response) {
          if (response.success) {
            location.href = checkUrl;
          }
        },
        error: function () {},
      });
    }
  }
}

function fetchSwitchBetweenExpressAndCourierProductDetails() {
  $.ajax({
    type: "get",
    url: switchProductUrl,
    data: [],
    success: function (response) {
      if (response.status === true) {
        $("#switchProductId").show();
        $("#switchProductId").html(response.html);
      } else {
        $("#switchProductId").hide();
      }
    },
  });
}

function wishlistCheckedCall(formValue, checkedValue, wishlistId) {
  if (checkedValue === true) {
    addproductToWishlist(formValue);
  } else {
    let wid = $("#wItemId").val();
    if (wid !== null && wid !== "undefined" && wid !== "") {
      deleteWishlistItem(wid);
    } else {
      deleteWishlistItem(wishlistId);
    }
  }
}

function addproductToWishlist(formValue) {
  // use $.ajax() to upload file
  let url = $(formValue).attr("action");
  let data = $(formValue).serialize();
  $.ajax({
    url: url,
    type: "POST",
    data: data,
    success: function (res) {
      if (res.success === true) {
        adVtrInt();
        if (res.itemCount !== 0) {
          $("#setImageWithHeart").attr(
            "src",
            "https://assets.winni.in/groot/2023/06/30/wishlist/heart-with-fill.svg"
          );
          $("#setImageWithHeartDesktop").attr(
            "src",
            "https://assets.winni.in/groot/2023/11/20/desktop/header-image/pink-image-heart.svg"
          );
        } else {
          $("#setImageWithHeart").attr(
            "src",
            "https://assets.winni.in/groot/2023/06/30/wishlist/heart-without-fill.svg"
          );
          $("#setImageWithHeartDesktop").attr(
            "src",
            "https://assets.winni.in/groot/2023/11/20/desktop/heart-svg.svg"
          );
        }
        $("#wItemId").val(res.wishlistId);
      } else {
        $("#setImageWithHeart").attr(
          "src",
          "https://assets.winni.in/groot/2023/06/30/wishlist/heart-without-fill.svg"
        );
        $("#setImageWithHeartDesktop").attr(
          "src",
          "https://assets.winni.in/groot/2023/11/20/desktop/heart-svg.svg"
        );
      }
    },
    error: function (err) {
      console.error(err.message);
    },
  });
}

function showBuyNowButtons() {
  $("#parent-wrapper-add-to-cart").removeClass("hide");
  $("#wrapper-earliest-delivery").show();
  $("#countdownTimer").show();
  $("#wrapper-add-to-cart").show();
  $(".addToCart").prop("disabled", false);
  $("#wrapper-product-not-available").addClass("hide");
  $("#wrapper-product-out-of-stock").addClass("hide");
}

function hideBuyNowButtons() {
  $("#parent-wrapper-add-to-cart").addClass("hide");
  $("#wrapper-earliest-delivery").hide();
  $("#countdownTimer").hide();
  $("#wrapper-add-to-cart").hide();
  $(".addToCart").prop("disabled", true);
  $("#wrapper-product-not-available").removeClass("hide");
  $("#wrapper-product-out-of-stock").addClass("hide");
}

function genSku() {
  var productName = $("#ntProductName").val();
  var variantSkuInitName = productName
    .replace(/[^a-zA-Z0-9]/g, "")
    .concat("-", "VAR");
  var sku = variantSkuInitName;
  var attributeMap = {};
  let attributePriority;
  let attributeValue;
  //var weightName;
  var selectAtts = $(".prod-att-radio");
  if (selectAtts.length !== 0) {
    attributeValue = $(selectAtts).filter(":checked").data("name");
    if (attributeValue) {
      attributePriority = $(selectAtts).data("priority");
      attributeMap[attributePriority] = attributeValue;
    }
  }
  var selectWeightAtts = $(".selected-weight"); // mobile
  if (selectWeightAtts.length !== 0) {
    attributeValue = $(selectWeightAtts).data("name");
    if (attributeValue) {
      attributePriority = $(selectWeightAtts).data("priority");
      attributeMap[attributePriority] = attributeValue;
    }
  }

  var selectedMobileWeight = $(".prod-attr");
  if (selectedMobileWeight.length > 0 && selectedMobileWeight.val()) {
    //  sku = sku.concat("-", selectedMobileWeight.val());
    attributeValue = selectedMobileWeight.val();
    attributePriority = $(selectedMobileWeight).data("priority");
    attributeMap[attributePriority] = attributeValue;
  }
  var eggAtts = $(".prod-eg-check");
  if (eggAtts.length !== 0) {
    attributePriority = $(eggAtts).data("priority");
    if ($(eggAtts).prop("checked") === true) {
      // sku = sku.concat("-", "TRUE");
      attributeMap[attributePriority] = "TRUE";
    } else {
      //sku = sku.concat("-", "FALSE");
      attributeMap[attributePriority] = "FALSE";
    }
  }
  var heartAtts = $(".prod-hs-check");
  if (heartAtts.length !== 0) {
    attributePriority = $(heartAtts).data("priority");
    if ($(heartAtts).prop("checked") === true) {
      //sku = sku.concat("-", "TRUE");
      attributeMap[attributePriority] = "TRUE";
    } else {
      //sku = sku.concat("-", "FALSE");
      attributeMap[attributePriority] = "FALSE";
    }
  }
  if ($("#proFlavorType").length != 0) {
    // flavor desktop
    attributeValue = $("#proFlavorType").find(":selected").text();
    // sku = sku.concat("-", flavourValue);
    attributePriority = $("#proFlavorType").data("priority");
    attributeMap[attributePriority] = attributeValue;
  }
  if ($("#proFlavorTypeMobile").length != 0) {
    // flavor mobile
    attributeValue = $("#proFlavorTypeMobile").find(":selected").text();
    //sku = sku.concat("-", flavourValueMobile);
    attributePriority = $("#proFlavorTypeMobile").data("priority");
    attributeMap[attributePriority] = attributeValue;
  }
  var selectAtts = $(".prod-att-cupOfCake"); // desktop
  if (selectAtts.length !== 0) {
    attributeValue = $(selectAtts).filter(":checked").val();
    if (typeof attributeValue !== "undefined") {
      // sku = sku.concat("-", cupCakeValue);
      attributePriority = $(selectAtts).data("priority");
      attributeMap[attributePriority] = attributeValue;
    }
  }
  var selectAttProductType = $(".prod-att-productType");
  if (selectAttProductType.length !== 0) {
    //sku = sku.concat("-", $(selectAttProductType).filter(":checked").data('name'));
    attributeValue = $(selectAttProductType).filter(":checked").data("name");
    attributePriority = $(selectAttProductType).data("priority");
    attributeMap[attributePriority] = attributeValue;
  }

  var selectedCocAvail = $(".prod-attr-coc");
  if (
    selectedCocAvail.length > 0 &&
    selectedCocAvail.hasClass("selected-coc")
  ) {
    // sku = sku.concat("-", selectedCocAvail.attr('value'));
    attributeValue = selectedCocAvail.attr("value");
    attributePriority = $(selectedCocAvail).data("priority");
    attributeMap[attributePriority] = attributeValue;
  }
  if (Object.keys(attributeMap).length > 0) {
    for (var key of Object.keys(attributeMap)) {
      if (attributeMap[key]) {
        sku = sku.concat("-", attributeMap[key]);
      }
    }
  }
  if (sku === variantSkuInitName) {
    sku = sku.concat("-", "DEFAULT");
  }
  if (sku === variantSkuInitName + "-") {
    sku = sku.concat("DEFAULT");
  }
  return sku.replace(/\s/g, "").replace(".", "\\.").toUpperCase();
}

$(".prod-att-radio").change(function () {
  $(".addCrt").show();
  $(".goToCart").hide();
  $("#addToCartButton").removeClass("add-to-crt");
});

$(".prod-att-cupOfCake, .prod-att-productType, .prod-att-checkbox").change(
  function () {
    $(".addCrt").show();
    $(".goToCart").hide();
    $("#addToCartButton").removeClass("add-to-crt");
  }
);

$(".prod-attr-coc, .prod-attr, .prod-attr-shape").click(function () {
  $(".addCrt").show();
  $(".goToCart").hide();
  $("#addToCartButton").removeClass("add-to-crt");
});

$("#pincode_Clear").on("click", function () {
  addclearPincodeAddress();
});
