<div>
    <x-slot name="title">Beranda</x-slot>

    <div class="line4-bt pb-12">
        <div class="tf-container">
            <div class="d-flex gap-12 justify-content-between align-items-center">
                <div class="search-box">
                    <input type="text" class="search-field" placeholder="Search  for products...">
                    <a href="search.html" class="right-icon icon-search"></a>
                </div>
                <a href="#filter" class="btn-filter" data-bs-toggle="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                        fill="none">
                        <g clip-path="url(#clip0_65_4519)">
                            <path
                                d="M0.666667 3.1666H2.49067C2.63376 3.69308 2.94612 4.15786 3.37955 4.48922C3.81299 4.82057 4.34341 5.0001 4.889 5.0001C5.43459 5.0001 5.96501 4.82057 6.39845 4.48922C6.83188 4.15786 7.14424 3.69308 7.28733 3.1666H15.3333C15.5101 3.1666 15.6797 3.09636 15.8047 2.97133C15.9298 2.84631 16 2.67674 16 2.49993C16 2.32312 15.9298 2.15355 15.8047 2.02852C15.6797 1.9035 15.5101 1.83326 15.3333 1.83326H7.28733C7.14424 1.30677 6.83188 0.841999 6.39845 0.510641C5.96501 0.179283 5.43459 -0.000244141 4.889 -0.000244141C4.34341 -0.000244141 3.81299 0.179283 3.37955 0.510641C2.94612 0.841999 2.63376 1.30677 2.49067 1.83326H0.666667C0.489856 1.83326 0.320286 1.9035 0.195262 2.02852C0.0702379 2.15355 0 2.32312 0 2.49993C0 2.67674 0.0702379 2.84631 0.195262 2.97133C0.320286 3.09636 0.489856 3.1666 0.666667 3.1666ZM4.88867 1.33326C5.11941 1.33326 5.34497 1.40169 5.53683 1.52988C5.72869 1.65808 5.87822 1.84028 5.96653 2.05346C6.05483 2.26665 6.07793 2.50122 6.03292 2.72753C5.9879 2.95385 5.87679 3.16173 5.71362 3.32489C5.55046 3.48805 5.34258 3.59916 5.11627 3.64418C4.88996 3.68919 4.65538 3.66609 4.4422 3.57779C4.22902 3.48949 4.04681 3.33995 3.91862 3.14809C3.79042 2.95624 3.722 2.73067 3.722 2.49993C3.72235 2.19062 3.84538 1.89408 4.0641 1.67536C4.28281 1.45664 4.57936 1.33361 4.88867 1.33326ZM15.3333 7.33326H13.5093C13.3665 6.80665 13.0542 6.34171 12.6208 6.01021C12.1874 5.67872 11.657 5.49911 11.1113 5.49911C10.5657 5.49911 10.0352 5.67872 9.60182 6.01021C9.16842 6.34171 8.85619 6.80665 8.71333 7.33326H0.666667C0.489856 7.33326 0.320286 7.4035 0.195262 7.52852C0.0702379 7.65355 0 7.82312 0 7.99993C0 8.17674 0.0702379 8.34631 0.195262 8.47133C0.320286 8.59636 0.489856 8.6666 0.666667 8.6666H8.71333C8.85619 9.19321 9.16842 9.65815 9.60182 9.98964C10.0352 10.3211 10.5657 10.5008 11.1113 10.5008C11.657 10.5008 12.1874 10.3211 12.6208 9.98964C13.0542 9.65815 13.3665 9.19321 13.5093 8.6666H15.3333C15.5101 8.6666 15.6797 8.59636 15.8047 8.47133C15.9298 8.34631 16 8.17674 16 7.99993C16 7.82312 15.9298 7.65355 15.8047 7.52852C15.6797 7.4035 15.5101 7.33326 15.3333 7.33326ZM11.1113 9.1666C10.8806 9.1666 10.655 9.09817 10.4632 8.96998C10.2713 8.84178 10.1218 8.65957 10.0335 8.44639C9.94517 8.23321 9.92207 7.99864 9.96708 7.77232C10.0121 7.54601 10.1232 7.33813 10.2864 7.17497C10.4495 7.01181 10.6574 6.9007 10.8837 6.85568C11.11 6.81066 11.3446 6.83377 11.5578 6.92207C11.771 7.01037 11.9532 7.15991 12.0814 7.35176C12.2096 7.54362 12.278 7.76918 12.278 7.99993C12.2776 8.30924 12.1546 8.60578 11.9359 8.8245C11.7172 9.04321 11.4206 9.16624 11.1113 9.1666ZM15.3333 12.8333H7.28733C7.14424 12.3068 6.83188 11.842 6.39845 11.5106C5.96501 11.1793 5.43459 10.9998 4.889 10.9998C4.34341 10.9998 3.81299 11.1793 3.37955 11.5106C2.94612 11.842 2.63376 12.3068 2.49067 12.8333H0.666667C0.489856 12.8333 0.320286 12.9035 0.195262 13.0285C0.0702379 13.1535 0 13.3231 0 13.4999C0 13.6767 0.0702379 13.8463 0.195262 13.9713C0.320286 14.0964 0.489856 14.1666 0.666667 14.1666H2.49067C2.63376 14.6931 2.94612 15.1579 3.37955 15.4892C3.81299 15.8206 4.34341 16.0001 4.889 16.0001C5.43459 16.0001 5.96501 15.8206 6.39845 15.4892C6.83188 15.1579 7.14424 14.6931 7.28733 14.1666H15.3333C15.5101 14.1666 15.6797 14.0964 15.8047 13.9713C15.9298 13.8463 16 13.6767 16 13.4999C16 13.3231 15.9298 13.1535 15.8047 13.0285C15.6797 12.9035 15.5101 12.8333 15.3333 12.8333ZM4.88867 14.6666C4.65792 14.6666 4.43236 14.5982 4.2405 14.47C4.04864 14.3418 3.89911 14.1596 3.81081 13.9464C3.72251 13.7332 3.6994 13.4986 3.74442 13.2723C3.78943 13.046 3.90055 12.8381 4.06371 12.675C4.22687 12.5118 4.43475 12.4007 4.66106 12.3557C4.88737 12.3107 5.12195 12.3338 5.33513 12.4221C5.54831 12.5104 5.73052 12.6599 5.85871 12.8518C5.98691 13.0436 6.05533 13.2692 6.05533 13.4999C6.0548 13.8092 5.93172 14.1056 5.71304 14.3243C5.49436 14.543 5.19792 14.6661 4.88867 14.6666Z"
                                fill="#151515" />
                        </g>
                        <defs>
                            <clipPath id="clip0_65_4519">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="line4-bt pt-16 pb-16">
        <div class="tf-container">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Categories</h5>
                <a href="category.html" class="d-flex align-items-center gap-4 text-secondary">
                    View all
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                        fill="none">
                        <path
                            d="M4.4996 9.50001C4.56541 9.50039 4.63064 9.48778 4.69156 9.4629C4.75248 9.43802 4.80788 9.40135 4.8546 9.35501L7.8546 6.35501C7.94773 6.26133 8 6.13461 8 6.00251C8 5.87042 7.94773 5.7437 7.8546 5.65001L4.8546 2.65001C4.75895 2.5681 4.63592 2.5253 4.51008 2.53016C4.38424 2.53502 4.26487 2.58718 4.17582 2.67623C4.08678 2.76528 4.03461 2.88465 4.02975 3.01049C4.02489 3.13632 4.06769 3.25936 4.1496 3.35501L6.7946 6.00001L4.1496 8.64501C4.07939 8.71465 4.03141 8.80354 4.01171 8.90045C3.99202 8.99735 4.00151 9.09792 4.03897 9.18944C4.07643 9.28096 4.14019 9.35931 4.22218 9.41459C4.30417 9.46987 4.40072 9.4996 4.4996 9.50001Z"
                            fill="#787982" />
                    </svg>
                </a>
            </div>
            <ul class="mt-16 box-category">
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product1.png" alt="">
                        </div>
                        Drinks
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product2.png" alt="">
                        </div>
                        Cake
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product3.png" alt="">
                        </div>
                        Meat
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product4.png" alt="">
                        </div>
                        Milk & Eggs
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product5.png" alt="">
                        </div>
                        Frozen Food
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product6.png" alt="">
                        </div>
                        Fruit
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product7.png" alt="">
                        </div>
                        Snacks
                    </a>
                </li>
                <li>
                    <a href="details-category-drink.html" class="category-item">
                        <div class="box-img-product">
                            <img src="images/product/product8.png" alt="">
                        </div>
                        Fish
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="pt-16 pb-16 line4-bt">
        <div class="tf-container">
            <div class="swiper tf-swiper swiper-wrapper-lr" data-space-between="12" data-preview="1.2" data-tablet="1.5"
                data-desktop="2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="voucher-details.html" class="banner-style1">
                            <div class="content-left">
                                <span class="title">SALE OFF</span>
                                <p class="text-onSurface text-caption">Organic ingredients made easy</p>
                                <div class="mt-6">
                                    <span class="text-secondary text-sm-start">Starting at :</span> <span
                                        class="text-primary fw-5 text-sm-start">$21.5</span>
                                </div>
                            </div>
                            <div class="box-img">
                                <img src="images/vegetable/banner1.png" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner-style2" style="background-image: url(images/background/bg-1.jpg);">
                            <div class="content-left">
                                <p class="text-white fw-5 text-caption">Discount 50% All <br> Products</p>
                                <a href="voucher-details.html" class="mt-12 tf-btn">Purchase now!</a>
                            </div>
                            <div class="content-right">
                                <div class="top">
                                    <div class="box-img">
                                        <img src="images/vegetable/img-1.png" alt="">
                                    </div>
                                    <div class="box-img">
                                        <img src="images/vegetable/img-2.png" alt="">

                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="box-img">
                                        <img src="images/vegetable/img-3.png" alt="">

                                    </div>
                                    <div class="box-img">
                                        <img src="images/vegetable/img-4.png" alt="">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="pt-16 pb-16 line4-bt">
        <div class="tf-container">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Flash Sale</h5>
                <p><span class="js-countdown countdown" data-timer="75000" data-labels=" :  ,  : , : , "></span></p>
            </div>
            <div class="mt-16 swiper tf-swiper-2 swiper-wrapper-lr" data-space-between="12" data-preview="3.2"
                data-tablet="3.2" data-desktop="4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="product-details.html" class="box-product">
                            <div class="img">
                                <img src="images/product/product9.png" alt="">
                            </div>
                            <div class="progress progress-product">
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <ul class="mt-4">
                                <li class="text-onSurface fw-6">$19.99</li>
                                <li class="text-sm-start">$39.00</li>
                            </ul>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="product-details.html" class="box-product">
                            <div class="img">
                                <img src="images/product/product10.png" alt="">
                            </div>
                            <div class="progress progress-product">
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <ul class="mt-4">
                                <li class="text-onSurface fw-6">$29.99</li>
                                <li class="text-sm-start">$21.99</li>
                            </ul>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="product-details.html" class="box-product">
                            <div class="img">
                                <img src="images/product/product11.png" alt="">
                            </div>
                            <div class="progress progress-product">
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <ul class="mt-4">
                                <li class="text-onSurface fw-6">$15.00</li>
                                <li class="text-sm-start">$20.00</li>
                            </ul>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="product-details.html" class="box-product">
                            <div class="img">
                                <img src="images/product/product2.png" alt="">
                            </div>
                            <div class="progress progress-product">
                                <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">70%</div>
                            </div>
                            <ul class="mt-4">
                                <li class="text-onSurface fw-6">$99.99</li>
                                <li class="text-sm-start">$100.00</li>
                            </ul>
                        </a>
                    </div>

                </div>
            </div>


        </div>
    </div>
    <div class="fixed-cart">
        <a href="my-cart.html" class="cart-icon badge-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"
                fill="none">
                <g clip-path="url(#clip0_1_751)">
                    <path
                        d="M8.61989 25.7603C9.19263 25.7603 9.65693 25.2588 9.65693 24.6403C9.65693 24.0217 9.19263 23.5203 8.61989 23.5203C8.04715 23.5203 7.58286 24.0217 7.58286 24.6403C7.58286 25.2588 8.04715 25.7603 8.61989 25.7603Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M20.0281 25.7603C20.6008 25.7603 21.0651 25.2588 21.0651 24.6403C21.0651 24.0217 20.6008 23.5203 20.0281 23.5203C19.4554 23.5203 18.9911 24.0217 18.9911 24.6403C18.9911 25.2588 19.4554 25.7603 20.0281 25.7603Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M0.324066 2.23999H4.47221L7.25147 17.2368C7.3463 17.7524 7.60604 18.2156 7.98522 18.5453C8.3644 18.8749 8.83886 19.0501 9.32555 19.04H19.4055C19.8922 19.0501 20.3667 18.8749 20.7459 18.5453C21.1251 18.2156 21.3848 17.7524 21.4796 17.2368L23.1389 7.83999H5.50925"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <clipPath id="clip0_1_751">
                        <rect width="28" height="28" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <i class="badge danger">2</i>
        </a>
    </div>


</div>
