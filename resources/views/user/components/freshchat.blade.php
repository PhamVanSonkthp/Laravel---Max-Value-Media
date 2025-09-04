<script src='//fw-cdn.com/14179730/5998207.js' chat='true'></script>

<script>
    function fw_chat_widget() {
        window.fcWidget.init({
            token: "/B2EGaZmttnOMOiZSeYbVZPAc6dHUs1QnKU0gNzMB7Y=",
            host: "https://wchat.freshchat.com"
        });

        // ✅ Copy this part below init

        // Set unique user id (from your system)
        window.fcWidget.setExternalId("{{auth()->id()}}");

        // Set user name
        window.fcWidget.user.setFirstName("#{{auth()->id() ." - ".auth()->user()->name}}");

        // Set user email
        window.fcWidget.user.setEmail("{{auth()->user()->email}}");

        // Set user custom properties
        window.fcWidget.user.setProperties({
            cf_plan: "Pro",      // custom property
            cf_status: "Active"  // custom property
        });
    }

    // load the widget after DOM ready
    (function(d, t) {
        var f = d.getElementsByTagName(t)[0],
            e = d.createElement(t);
        e.async = true;
        e.src = 'https://wchat.freshchat.com/js/widget.js';
        e.onload = fw_chat_widget;
        f.parentNode.insertBefore(e, f);
    })(document, 'script');
</script>
