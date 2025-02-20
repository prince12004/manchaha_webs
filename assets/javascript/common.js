$(document).ready(function() {
    $('#sidebar').hover(
        function() {
            // Mouse enter sidebar
            $(this).addClass('expanded');
            $('#main-content').addClass('collapsed');
        },
        function() {
            // Mouse leave sidebar
            $(this).removeClass('expanded');
            $('#main-content').removeClass('collapsed');
        }
    );

    // Close sidebar on close button click
    $('#sidebar .close-btn').click(function() {
        $('#sidebar').removeClass('expanded');
        $('#main-content').removeClass('collapsed');
    });
});



$(document).ready(function() {
    $('.notification-icon').on('click', function() {
        $('.notify-dropdown').toggle();
    });

    const cartDropdown = $('.notify-dropdown');

    cartItems.forEach(item => {
        const initials = getInitials(item.sender);
        const cartItem = `
            <div class="cart-item">
                <div class=" d-flex align-items-center gap-1">
                   <div class="initials-logo">${initials}</div>
                   <strong>${item.sender} ${item.role ? `(${item.role})` : ''}</strong>
                </div>
                <div>
                    <p>${item.message}</p>
                    <small>${item.date}</small>
                </div>
            </div>
        `;
        cartDropdown.append(cartItem);
    });
});
