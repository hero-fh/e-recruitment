<link rel="stylesheet" href="<?php echo base_url ?>build/scss/chathead.scss">

<!-- <link rel="stylesheet" href="<?php echo base_url ?>dist/css/countdown_styles.css"> -->
<style>
    /* 
body {
  color: #000000;
} */

    .flip-card {
        position: relative;
        display: inline-flex;
        flex-direction: column;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .2);
        border-radius: .1em;
    }

    .top,
    .bottom,
    .flip-card .top-flip,
    .flip-card .bottom-flip {
        height: .75em;
        line-height: 1;
        padding: .25em;
        overflow: hidden;
    }

    .top,
    .flip-card .top-flip {
        background-color: #f7f7f7;
        border-top-right-radius: .1em;
        border-top-left-radius: .1em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .bottom,
    .flip-card .bottom-flip {
        background-color: white;
        display: flex;
        align-items: flex-end;
        border-bottom-right-radius: .1em;
        border-bottom-left-radius: .1em;
    }

    .flip-card .top-flip {
        position: absolute;
        width: 100%;
        animation: flip-top 250ms ease-in;
        transform-origin: bottom;
    }

    @keyframes flip-top {
        100% {
            transform: rotateX(90deg);
        }
    }

    .flip-card .bottom-flip {
        position: absolute;
        bottom: 0;
        width: 100%;
        animation: flip-bottom 250ms ease-out 250ms;
        transform-origin: top;
        transform: rotateX(90deg);
    }

    @keyframes flip-bottom {
        100% {
            transform: rotateX(0deg);
        }
    }

    .container1 {
        display: flex;
        gap: .5em;
        justify-content: center;
        /* margin-top: 100px; */
        /* margin-left: 50px; */
        font-size: 2.25rem;
        /* max-width: 1px; */
    }

    .container-segment {
        display: flex;
        flex-direction: column;
        gap: .1em;
        align-items: center;
    }

    .segment {
        display: flex;
        gap: .1em;
    }

    .segment-title {
        font-size: 1rem;
    }
</style>
<div class="chat_container">
    <div class="bubble"></div>
    <div class="chat">
        <div class="container1 ">
            <div class="container-segment">
                <div class="segment-title">Hours</div>
                <div class="segment">
                    <div class="flip-card" data-hours-tens>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                    </div>
                    <div class="flip-card" data-hours-ones>
                        <div class="top">1</div>
                        <div class="bottom">1</div>
                    </div>
                </div>
            </div>
            <div class="container-segment">
                <div class="segment-title">Minutes</div>
                <div class="segment">
                    <div class="flip-card" data-minutes-tens>
                        <div class="top">3</div>
                        <div class="bottom">3</div>
                    </div>
                    <div class="flip-card" data-minutes-ones>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                    </div>
                </div>
            </div>
            <div class="container-segment">
                <div class="segment-title">Seconds</div>
                <div class="segment">
                    <div class="flip-card" data-seconds-tens>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                    </div>
                    <div class="flip-card" data-seconds-ones>
                        <div class="top">0</div>
                        <div class="bottom">0</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
    $(".bubble").draggable();

    var isMoving = false;
    var isdragging = false;
    var chatMode = false;

    function closeChat() {
        $(".bubble").css("top", "10%").css("left", "50%").css("transition", "all 0.5s");
        $(".chat").addClass("bounceout").removeClass("bouncein");
        $(".chat").replaceWith($(".chat").clone(true));
    }

    let isCodeExecuted = false;

    $(".bubble").on("click", function() {

        var pos = $(".chat_container").offset();

        if (chatMode) {
            closeChat();
            chatMode = false;
        } else {
            $(".chat").addClass("bouncein").removeClass("bounceout");
            // $(".bubble").css("top", (pos.top + 30) + "px").css("left", (pos.left - 70) + "px").css("transition", "all 0.3s");
            $(".chat").replaceWith($(".chat").clone(true));
            chatMode = true;
        }
        if (!isCodeExecuted) {
            console.log('outside');
            const countToDate = (+new Date) + (90000 * 60);
            // const countToDate = new Date().setHours(new Date().getHours())
            let previousTimeBetweenDates
            setInterval(() => {
                const currentDate = new Date()
                const timeBetweenDates = Math.ceil((countToDate - currentDate) / 1000)
                flipAllCards(timeBetweenDates)

                previousTimeBetweenDates = timeBetweenDates
            }, 250)

            function flipAllCards(time) {
                const seconds = time % 60
                const minutes = Math.floor(time / 60) % 60
                const hours = Math.floor(time / 3600)

                flip(document.querySelector("[data-hours-tens]"), Math.floor(hours / 10))
                flip(document.querySelector("[data-hours-ones]"), hours % 10)
                flip(document.querySelector("[data-minutes-tens]"), Math.floor(minutes / 10))
                flip(document.querySelector("[data-minutes-ones]"), minutes % 10)
                flip(document.querySelector("[data-seconds-tens]"), Math.floor(seconds / 10))
                flip(document.querySelector("[data-seconds-ones]"), seconds % 10)
            }

            function flip(flipCard, newNumber) {
                const topHalf = flipCard.querySelector(".top")
                const startNumber = parseInt(topHalf.textContent)
                if (newNumber === startNumber) return

                const bottomHalf = flipCard.querySelector(".bottom")
                const topFlip = document.createElement("div")
                topFlip.classList.add("top-flip")
                const bottomFlip = document.createElement("div")
                bottomFlip.classList.add("bottom-flip")

                top.textContent = startNumber
                bottomHalf.textContent = startNumber
                topFlip.textContent = startNumber
                bottomFlip.textContent = newNumber

                topFlip.addEventListener("animationstart", e => {
                    topHalf.textContent = newNumber
                })
                topFlip.addEventListener("animationend", e => {
                    topFlip.remove()
                })
                bottomFlip.addEventListener("animationend", e => {
                    bottomHalf.textContent = newNumber
                    bottomFlip.remove()
                })
                flipCard.append(topFlip, bottomFlip)
            }
            isCodeExecuted = true;
        }
    });

    $(".bubble").mousedown(function() {
        isdragging = false;
    });

    $(".bubble").mousemove(function() {
        isdragging = true;
        $(this).css("transition", "all 0s");
    });

    $(".bubble").mouseup(function(e) {
        e.preventDefault();
        var lastY = window.event.clientY;
        var lastX = window.event.clientX;
        var swidth = $(window).width();

        if (isdragging) {

            if (chatMode) {
                chatMode = false;
                closeChat();
            }

            if (lastX > (swidth / 2)) {
                $(this).css("top", lastY).css("left", (swidth - 55) + "px").css("transition", "all 0.4s");
            } else {
                $(this).css("top", lastY).css("left", "10%").css("transition", "all 0.4s");
            }
        }
    });
</script>