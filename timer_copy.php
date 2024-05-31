<link rel="stylesheet" href="<?php echo base_url ?>build/scss/calendar.scss">

<!-- <link rel="stylesheet" href="<?php echo base_url ?>dist/css/countdown_styles.css"> -->
<!-- <style>
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
</style> -->


<!-- main codes start -->





<!-- main codes start -->
<div class="outer">
    <div class="signboard front inner anim04c">
        <li class="year anim04c">
            <span></span>
        </li>
        <ul class="calendarMain anim04c">

            <li class="second anim04c">
                <span>00</span>
            </li>

        </ul>
        <li class="clock minute anim04c">
            <span></span>
        </li>

    </div>
    <div class="signboard left inner anim04c">
        <li class="clock hour anim04c">
            <span></span>
        </li>

    </div>
    <div class="signboard right inner anim04c">
        <li class="clock second anim04c">
            <span></span>
        </li>

    </div>
</div>
<!-- main codes end -->


<!-- <div class="hour">01</div>
<div class="minute">00</div>
<div class="second">00</div>
 -->




<script>
    $(document).ready(function() {

        var totalMinutes = 2; // Set the total minutes for the countdown
        var minutes = totalMinutes % 60;
        var hours = Math.floor(totalMinutes / 60);
        var seconds = 0;

        setInterval(function() {
            if (seconds === 0) {
                if (minutes === 0 && hours === 0) {
                    // Countdown is finished
                    clearInterval();
                    return;
                }
                if (minutes === 0) {
                    hours--;
                    minutes = 59;
                } else {
                    minutes--;
                }
                seconds = 59;
            } else {
                seconds--;
            }

            $(".hour").html((hours < 10 ? "0" : "") + hours);
            $(".minute").html((minutes < 10 ? "0" : "") + minutes);
            $(".second").html((seconds < 10 ? "0" : "") + seconds);
        }, 1000);



        // var newDate = new Date();
        // newDate.setDate(newDate.getDate());

        // setInterval(function() {
        //     var hours = new Date().getHours();
        //     $(".hour").html((hours < 10 ? "0" : "") + hours);
        //     var seconds = new Date().getSeconds();
        //     $(".second").html((seconds < 10 ? "0" : "") + seconds);
        //     var minutes = new Date().getMinutes();
        //     $(".minute").html((minutes < 10 ? "0" : "") + minutes);
        // }, 1000);



        // $(".outer").on({
        //     mousedown: function() {
        //         $(".dribbble").css("opacity", "1");
        //     },
        //     mouseup: function() {
        //         $(".dribbble").css("opacity", "0");
        //     }
        // });

        // const dateRange = "01/08/2023 - 06/08/2023";

        // // Split the date range into start and end dates
        // const [startStr, endStr] = dateRange.split(" - ");

        // // Parse the start and end dates
        // const startDate = new Date(startStr);
        // const endDate = new Date(endStr);

        // // Calculate the difference in months
        // const months = (endDate.getFullYear() - startDate.getFullYear()) * 12 + (endDate.getMonth() - startDate.getMonth());

        // // Calculate the difference in years
        // const years = Math.floor(months / 12);

        // console.log("Months:", months);
        // console.log("Years:", years);

    });
</script>