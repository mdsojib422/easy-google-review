;(function ($) {
    $(document).ready(function () {
        const $tabItems = $('.easygr-tab-item');
        const $tabContents = $('.easygr-tab-content');
        const $connectBtn = $('#easygr-connect-btn');
        const $disconnectBtn = $('#easygr-discount');
        const $syncBtn = $('#easygr-sync');

        // Tab switching functionality
        $tabItems.on('click', function () {
            const index = $tabItems.removeClass('easygr-active-tab').index(this);
            $tabContents.hide().eq(index).show();
            $(this).addClass('easygr-active-tab');
        });

        // Initially hide all tab contents except the active one
        const activeTabIndex = $tabItems.index($('.easygr-active-tab'));
        $tabContents.hide().eq(activeTabIndex).show();

        // Connect Button Functionality
        $connectBtn.on('click', function (e) {
            e.preventDefault();
            window.open(`https://phplaravel-1196969-4821714.cloudwaysapps.com/api/oauth?redirectUrl=${easygr.redirectUrl}`, '_self');
        });

        // Disconnect Button Functionality
        $disconnectBtn.on('click', function (e) {
            e.preventDefault();
            if (confirm("Are you sure you want to disconnect?")) {
                performAjaxAction('easygr_disconnect_apps', easygr.redirectUrl);
            }
        });

        // Sync Data Button Functionality
        $syncBtn.on('click', function (e) {
            e.preventDefault();
            performAjaxAction('easygr_sync_apps_data', easygr.redirectUrl);
        });

        // Reusable function for AJAX requests
        function performAjaxAction(action, redirectUrl) {
            $.ajax({
                url: easygr.ajax_url,
                type: 'POST',
                data: {
                    action: action,
                    nonce: easygr.nonce
                },
                success: function (response) {
                    if (response.success) {
                        window.location.replace(redirectUrl);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }
    });
})(jQuery);
