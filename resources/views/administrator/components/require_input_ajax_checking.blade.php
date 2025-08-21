<style>
    .title {
        font-weight: 600;
        margin-bottom: 6px;
        opacity: 0;
        transform: translateY(-5px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        color: #333;
    }

    .title.show {
        opacity: 1;
        transform: translateY(0);
    }

    .input-wrapper {
        position: relative;
        display: block;
        width: 100%;
    }

    input {
        padding: 10px 42px 10px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        outline: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        /* font-size: 15px; */
        background: #fff;
        position: relative;
        z-index: 2;

    }

    input.red {
        border-color: #e74c3c;
    }

    input.green {
        border-color: #27ae60;
    }

    /* Running border container */
    .running-border {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: 8px;
        background: linear-gradient(90deg,
        #f1c40f, transparent, #f1c40f, transparent);
        background-size: 300% 300%;
        z-index: 1;
        animation: moveBorder 2s linear infinite;
        display: none;
        pointer-events: none;
    }

    .running-border.show {
        display: block;
    }

    @keyframes moveBorder {
        0% {
            background-position: 0% 50%;
        }
        100% {
            background-position: 300% 50%;
        }
    }

    /* Spinner */
    .require_input_ajax_checking {
        position: absolute;
        top: 50%;
        right: 12px;
        width: 16px;
        height: 16px;
        border: 2px solid #ccc;
        border-top: 2px solid #f1c40f;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
        transform: translateY(-50%);
        display: none;
        z-index: 3;
    }

    .require_input_ajax_checking.show {
        display: block;
    }

    @keyframes spin {
        0% {
            transform: translateY(-50%) rotate(0deg);
        }
        100% {
            transform: translateY(-50%) rotate(360deg);
        }
    }
</style>

<div>
    <div id="require_input_ajax_checking_input_title" class="title show" style="color:#e74c3c;">Type your url below
    </div>
    <div class="input-wrapper">
        <input type="text" id="require_input_ajax_checking_color_input" placeholder="..." class="red">
        <div id="require_input_ajax_checking_running_border" class="running-border"></div>
        <div id="require_input_ajax_checking" class="require_input_ajax_checking"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        let typingTimer; // for debounce
        const delay = 200; // 200ms

        let value = "";

        const input = document.getElementById("require_input_ajax_checking_color_input");
        const title = document.getElementById("require_input_ajax_checking_input_title");
        const spinner = document.getElementById("require_input_ajax_checking");
        const border = document.getElementById("require_input_ajax_checking_running_border");

        input.addEventListener("input", () => {
            clearTimeout(typingTimer); // reset timer
            typingTimer = setTimeout(() => {
                value = input.value.trim().toLowerCase();

                // reset
                input.classList.remove("red", "green");
                title.classList.remove("show");
                spinner.classList.remove("show");
                border.classList.remove("show");

                if (value === "red") {
                    input.classList.add("red");
                    title.textContent = "🔥 You chose RED";
                    title.style.color = "#e74c3c";
                    title.classList.add("show");
                } else if (value === "green") {
                    input.classList.add("green");
                    title.textContent = "🌿 You chose GREEN";
                    title.style.color = "#27ae60";
                    title.classList.add("show");
                } else if (value.length > 0) {
                    spinner.classList.add("show");
                    border.classList.add("show");
                    title.textContent = "Checking...";
                    title.style.color = "#f1c40f";
                    title.classList.add("show");

                    callAjax(
                        "GET",
                        "{{route('ajax.user.website.checking_url_valid')}}",
                        {
                            url: $('#require_input_ajax_checking_color_input').val(),
                        },
                        (response) => {
                            if (response.data.url == value) {
                                spinner.classList.remove("show");
                                border.classList.remove("show");
                                if (response.code == 200) {
                                    input.classList.add("green");
                                    title.textContent = response.message;
                                    title.style.color = "#27ae60";
                                    title.classList.add("show");
                                } else {
                                    input.classList.add("red");
                                    title.textContent = response.message;
                                    title.style.color = "#e74c3c";
                                    title.classList.add("show");
                                }
                            }
                        },
                        (error) => {

                        }, false, false
                    )

                } else if (value.length == 0) {
                    input.classList.add("red");
                    title.textContent = "Type your url below";
                    title.style.color = "#e74c3c";
                    title.classList.add("show");
                }
            }, delay);
        });
    });
</script>
