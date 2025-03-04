




function vendorStatus(status, id) {
    if (!confirm("Are you sure you want to change the vendor status?")) {
        return;
    }

    fetch('Web/Admin/Admin/updateVendor', {  // Using your controller URL
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ is_verified: status, id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Vendor status updated successfully!");
            location.reload(); // Reload to reflect changes
        } else {
            alert("Failed to update vendor status.");
        }
    })
    .catch(error => console.error('Error:', error));
}



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
