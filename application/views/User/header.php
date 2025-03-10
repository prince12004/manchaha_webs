<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mnnchaha.com || <?= $cat['CategoryDescription'] ?? 'Top Rated Ecom Brand' ?></title>
    <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <style>
    .custom-dropdown {
        position: relative;
        display: inline-block;
        width: 200px;
    }

    .dropdown-btn {
        width: 100%;
        padding-left: 20px;
        background-color: #FFFFFF;
        border: 1px solid #FFFFFF;
        border-radius: 30px;
        text-align: left;
        color: #07AA2D;
        font-weight: 600;
        cursor: pointer;
    }

    .dropdown-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100%;
        left: 0;
        width: 90%;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        display: none;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .dropdown-option {
        padding: 10px;
        cursor: pointer;
        background-color: white;
    }

    .dropdown-option:hover {
        background-color: #007bff;
        color: #FFFFFF;
    }

    .submenu-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        left: 100%;
        top: 0;
        background-color: #FFFFFF;
        color: #777;
        border: 1px solid #ccc;
        display: none;
        height: auto;
        max-height: 400px;
        overflow-y: scroll;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .submenu-option {
        padding: 10px;
        cursor: pointer;
        background-color: white;
    }

    .submenu-option:hover {
        background-color: #007bff;
        color: #FFFFFF;
    }

    .custom-dropdown:hover .dropdown-list {
        display: block;
    }

    .dropdown-option:hover .submenu-list {
        display: block;
    }

    .dropdown-btn:focus {
        outline: none;
        border-color: #007bff;
    }

    .submenu-list::-webkit-scrollbar {
        display: none;
    }

    #iconss {
        margin-left: 8px;
    }
    </style>
</head>

<body>
    <header>



        <?php



if ($this->session->userdata('userToken')) {
    $token = $this->session->userdata('userToken');
    $jwt = new JWT();
    $JwtSecretKey = 'mysecret';
    $decodeToken = $jwt->decode($token, $JwtSecretKey, 'HS256');
    if ($decodeToken && isset($decodeToken[0]->UserID)) {
        $uid = $decodeToken[0]->UserID;
        
        $cartcount = $this->db->where(['user_id'=>$uid,'is_deleted'=>1])
                                      ->count_all_results('cart');
        $wishlistcount = $this->db->where(['userID'=>$uid,'is_deleted'=>1])
                                    ->count_all_results('wishlist');
        $wishlist = $this->db->select('wishlist.*')->from('wishlist')->where(['userID'=>$uid,'is_deleted'=>1])->get()->result_array();
	
    } 

}
?>
		
		
        <!-- Top Bar -->
        <nav class="navbar navbar-expand-lg top-bar">
            <div class="container-fluid am">
                <ul class="navbar-nav contact-mail-phone me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:info@example.com">
                            <img src="<?= base_url('assets/images/emails.png') ?>" alt=""> info@mnnchaha.com
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <img src="<?= base_url('assets/images/call.png') ?>" alt=""> Need help? Call Us <span
                                class="blue-text"> +91 9920401329</span>
                        </a>
                    </li>
                </ul>
                <div id="profile-menu">
                    <div class="become-button">
                       <a href="<?= base_url('Welcome/orderbulk') ?>">
                       <button>Bulk Order</button>
                            </a>
                        </div>
                    <ul id="mainprofileUL" class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                        <li class="nav-item position-relative ms-2">
                            <a class="nav-link" href="<?= base_url('Web/User/User/wishlist') ?>">
                                <img src="<?= base_url('assets/images/wishlist-nav.png') ?>" alt="" width="20px">
                                <?php if(isset($wishlistcount)&&$wishlistcount!=0){ ?>
                                <span class="notification-counter"><?= $wishlistcount?></span>
                                <?php } ?>
                                Wishlist
                            </a>
                        </li>
                        <?php if($this->session->userdata('userToken')){?>
                        <li class="nav-item position-relative ms-2">
                            <a class="nav-link" href="<?= base_url('Web/User/User/cart') ?>">
                                <img src="<?= base_url('assets/images/cart-nav.png') ?>" alt="Cart Icon" width="20px">
                                <?php if(isset($cartcount)&&$cartcount!=0){ ?>
                                <span class="notification-counter cart-counter">
                                    <?= isset($cartcount) ? $cartcount : '0'; ?>
                                </span>
                                <?php } ?>
                                My Cart
                            </a>

                        </li>
                        <?php }?>
                        <li class="nav-item  top-profile-dropmenu d-flex ">
                            <?php if($this->session->userdata('userToken')){?>
                            <div class="custom-dropdown" id="customDropdown">
                                <!-- Dropdown Trigger -->
                                <div class="custom-dropdown-toggle nav-link ms-2" id="dropdownToggle">
                                    <img src="<?= base_url('assets/images/profile-nav.png') ?>" alt="" width="20px">
                                    Profile
                                </div>

                                <!-- Dropdown Menu -->
                                <div class="custom-dropdown-menu" id="dropdownMenu">
                                    <a href="<?= base_url('Web/User/User/profile') ?>">
                                        <span class="material-symbols-outlined topNavIcon">
                                            manage_accounts
                                        </span> Account
                                    </a>
                                    <a href="<?= base_url('Web/User/User/order_history') ?>">
                                        <span class="material-symbols-outlined topNavIcon">
                                            orders
                                        </span> Order History
                                    </a>
                                    <a href="<?= base_url('Web/User/User/logout') ?>">
                                        <span class="material-symbols-outlined topNavIcon">
                                            logout
                                        </span> Logout
                                    </a>
                                </div>
                            </div>
                            <?php }else{?>
                            <a class="nav-link ms-2" href="<?= base_url('Welcome/loginpage')?>">
                                <img src="<?= base_url('assets/images/profile-nav.png') ?>" alt="" width="20px">
                                Login
                            </a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Header -->
        <nav class="navbar navbar-expand-lg header-main">
            <div class="container-fluid overflow-visible am">
                <a class="navbar-brand" href="<?= base_url('welcome/index') ?>">
                    <img src="<?= base_url('assets/images/header-new-logo.png') ?>" alt="Logo">
                </a>
                <div>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <img src="<?= base_url('assets/images/toggler-bar.png') ?>" alt="">
                    </button>
                    <button class="navbar-toggler ms-auto" id="profile-toggler" type="button">
                        <img src="<?= base_url('assets/images/profile-toggler.png') ?>" alt="" width="44px">
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarMain">
                <form class="search-bar d-flex ms-lg-5" role="search" onsubmit="return false;">
                <div class="custom-dropdown">
                    <button type="button" class="dropdown-btn" aria-label="Category select">
                        All Categories <i class="fa fa-chevron-down" id="iconss"></i>
                    </button>
                    <ul class="dropdown-list">
                        <!-- Categories will be dynamically added here -->
                    </ul>
                </div>

                <div class="search-container">
                    <label for="homeSearch" class="visually-hidden">Search Product</label>
                    <input 
                        class="form-control" 
                        id="homeSearch" 
                        name="homeSearch"
                        value="<?= set_value('homeSearch') ?>" 
                        type="text" 
                        placeholder="Search Product..." 
                        aria-label="Search" 
                        autocomplete="off" 
                        onkeydown="handleKeyDown(event)" 
                    />
                    <button type="button" onclick="homeSearch()" class="search-icon navSearchbtn">
                        <img class="lens" src="<?= base_url('assets/images/search-nav.png') ?>" alt="">
                    </button>
                    <div id="suggestions-container" class="suggestions-container"></div>
                </div>
            </form>

                    <li class="nav-item me-4 ms-3">
                        <a class="nav-link text-green d-flex align-items-center" href="">
                            <img class="me-1" src="<?= base_url('assets/images/greenFlame.png') ?>" alt=""> Deals
                        </a>
                    </li>
                    <ul class="navbar-nav main-nav-tab ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url() == base_url('welcome/index')) ? 'active-main-nav' : '' ?>"
                                href="<?= base_url('welcome/index') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url() == base_url('Web/Web/page/about')) ? 'active-main-nav' : '' ?>"
                                href="<?= base_url('Web/Web/page/about') ?>">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url() == base_url('welcome/contact_us')) ? 'active-main-nav' : '' ?>"
                                href="<?= base_url('welcome/contact_us') ?>">Contact Us</a>
                        </li>
                    </ul>

                    <button class="btn btn-dark contact-info d-flex">
                        <img src="<?= base_url('assets/images/navBtnHeader.png') ?>" alt="">
                        <div class="nav-btn-content">
                            <div class="big">+91 9920401329</div>
                            <div class="small">24 / 7 Support Center</div>
                        </div>
                    </button>
                </div>
            </div>
        </nav>
<script>
    function handleKeyDown(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevents the default form submission
        homeSearch(); // Executes your custom search function
    }
}

    function homeSearch() {
        event.preventDefault();
        let searchInput = document.getElementById('homeSearch').value;

// Redirect to the URL with the encoded search term
window.location.href = '<?= base_url('homeSearch/') ?>' + encodeURIComponent(searchInput);
        }
</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>


        document.addEventListener("DOMContentLoaded", function() {
            // Fetch categories dynamically
            function fetchCategories() {
                $.ajax({
                    url: '<?= base_url("get-categories") ?>', // Replace with your backend URL
                    type: 'POST',
                    success: function(response) {
                        if (response.status === 'success' && response.data.length > 0) {
                            const categoryList = document.querySelector(
                            '.dropdown-list'); // Use querySelector to get the first element
                            categoryList.innerHTML = ''; // Clear existing categories

                            response.data.forEach(function(category) {
                                // Create main category list item
                                const listItem = document.createElement('li');
                                listItem.classList.add('dropdown-option');
                                listItem.textContent = category.CategoryName;

                                // Add click event to main category
                                listItem.addEventListener('click', function() {
                                    window.location.href =
                                        '<?= base_url('Welcome/cardlist/') ?>' +
                                        category.CategoryID;
                                });

                                // Check if the category has subcategories
                                if (category.subcategories && category.subcategories
                                    .length > 0) {
                                    const submenuList = document.createElement('ul');
                                    submenuList.classList.add('submenu-list');

                                    category.subcategories.forEach(function(subcategory) {
                                        const submenuItem = document.createElement(
                                            'li');
                                        submenuItem.classList.add('submenu-option');
                                        submenuItem.textContent = subcategory
                                            .CategoryName;

                                        // Make subcategory clickable
                                        submenuItem.addEventListener('click',
                                            function(event) {
                                                event
                                            .stopPropagation(); // Prevent click event from triggering the parent category's event
                                                window.location.href =
                                                    '<?= base_url('Welcome/cardlist/') ?>' +
                                                    subcategory.CategoryID;
                                            });

                                        submenuList.appendChild(submenuItem);
                                    });

                                    listItem.appendChild(submenuList);
                                }

                                categoryList.appendChild(listItem);
                            });
                        } else {
                            console.log('No categories found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                        alert('An error occurred while fetching categories.');
                    }
                });
            }

            fetchCategories();
        });




        // ==================search suggestion starts==================        
        // Sample data for search suggestions (can be fetched from a backend API)
        const suggestions = [
            "Rings",
            "payal",
            "Nackless",
            "Nosepins",
            "kamarBand",
            "Nackless and Chains",
            "Mangalsutra",
            "Mangtika",
            "Earings",
            "Anklets",
            "Toe Rings",
            "Bajuband",
            "Armlets",
            "Studs",
        ];

        const searchInput = document.getElementById('homeSearch');
        const suggestionsContainer = document.getElementById('suggestions-container');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            if (query) {
                const filteredSuggestions = suggestions.filter(item =>
                    item.toLowerCase().includes(query)
                );
                showSuggestions(filteredSuggestions);
            } else {
                suggestionsContainer.style.display = 'none';
            }
        });

        function showSuggestions(suggestionsList) {
            suggestionsContainer.innerHTML = '';
            if (suggestionsList.length > 0) {
                suggestionsList.forEach(suggestion => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.classList.add('suggestion-item');
                    suggestionItem.textContent = suggestion;
                    suggestionItem.addEventListener('click', function() {
                        searchInput.value = suggestion;
                        suggestionsContainer.style.display = 'none';
                    });
                    suggestionsContainer.appendChild(suggestionItem);
                });
                suggestionsContainer.style.display = 'block';
            } else {
                suggestionsContainer.style.display = 'none';
            }
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                suggestionsContainer.style.display = 'none';
            }
        });

        // ==================search suggestion ends==================        




        $(document).ready(function() {

            const currentPath = window.location.pathname;

            function setActiveTabByPath(path) {
                $('.main-nav-tab .nav-item a').each(function() {
                    const $navLink = $(this);
                    const hrefPath = $navLink.attr('href');
                    if (path === hrefPath || path.includes(hrefPath)) {
                        $('.main-nav-tab .nav-link').removeClass('active-main-nav');
                        $navLink.addClass('active-main-nav');
                    }
                });
            }
            setActiveTabByPath(currentPath);
            $('.main-nav-tab .nav-item a').on('click', function() {
                $('.main-nav-tab .nav-link').removeClass(
                'active-main-nav'); // Remove active class from all links
                $(this).addClass('active-main-nav'); // Add active class to the clicked link
            });
        });


        $('#profile-toggler').on('click', function() {
            $('#profile-menu ul').toggleClass('show');
        });
        </script>

        <script>
        // Get the elements
        const dropdownButton = document.querySelector('.dropdown-btn');
        const dropdownList = document.querySelector('.dropdown-list');
        const dropdownOptions = document.querySelectorAll('.dropdown-option');
        const subMenus = document.querySelectorAll('.submenu-list');
        const submenuOptions = document.querySelectorAll('.submenu-option');

        // Toggle the dropdown when button is clicked
        dropdownButton.addEventListener('click', function() {
            dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
        });

        // Change button text when an option is clicked
        dropdownOptions.forEach(option => {
            option.addEventListener('click', function(event) {
                // Prevent click from closing the entire menu if it's a submenu
                if (!this.querySelector('.submenu-list')) {
                    dropdownButton.textContent = this.textContent;
                    dropdownList.style.display = 'none'; // Hide the dropdown after selection
                }
            });
        });

        // Optional: Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!dropdownList.contains(event.target) && !dropdownButton.contains(event.target)) {
                dropdownList.style.display = 'none'; // Close dropdown if click is outside
            }
        });
        </script>

</body>

</html>