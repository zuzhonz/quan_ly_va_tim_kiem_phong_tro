<style>
    body {
        color: #1a202c;
        text-align: left;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm > .col, .gutters-sm > [class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3, .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }


    .shadow-none {
        box-shadow: none !important;
    }

    .avatar_admin {
        position: relative;
        cursor: pointer;
        pointer-events: none;
    }

    .input_file {
        pointer-events: auto;
        max-width: 125px;
        cursor: pointer;
        opacity: 0;
        height: 160px;
        right: 38%;
        /*top: 5%;*/
        position: absolute;
    }

    #avatar:hover {
        filter: brightness(85%);
    }

    #loading {
        position: absolute;
        top: 4%;
        left: 8%;
    }

    @font-face {
        font-family: 'icomoon';
        src: url("data:application/x-font-ttf;charset=utf-8;base64,AAEAAAALAIAAAwAwT1MvMghi9pwAAAC8AAAAYGNtYXAgVsCNAAABHAAAAFRnYXNwAAAAEAAAAXAAAAAIZ2x5ZqNqZaUAAAF4AAAIFGhlYWQaRAp1AAAJjAAAADZoaGVhA+IB7AAACcQAAAAkaG10eBEAADQAAAnoAAAALGxvY2EGkAkoAAAKFAAAABhtYXhwABgA0AAACiwAAAAgbmFtZZlKCfsAAApMAAABhnBvc3QAAwAAAAAL1AAAACAAAwHgAZAABQAAAUwBZgAAAEcBTAFmAAAA9QAZAIQAAAAAAAAAAAAAAAAAAAABEAAAAAAAAAAAAAAAAAAAAABAAADgBgHg/+AAIAHgACAAAAABAAAAAAAAAAAAAAAgAAAAAAADAAAAAwAAABwAAQADAAAAHAADAAEAAAAcAAQAOAAAAAoACAACAAIAAQAg4Ab//f//AAAAAAAg4AD//f//AAH/4yAEAAMAAQAAAAAAAAAAAAAAAQAB//8ADwABAAAAAAAAAAAAAgAANzkBAAAAAAEAAAAAAAAAAAACAAA3OQEAAAAAAQAAAAAAAAAAAAIAADc5AQAAAAAIABwAAAHgAeAACwAXACMALwBIAGEAegCGAAATNDYzMhYVFAYjIiYXNDYzMhYVFAYjIiYXNDYzMhYVFAYjIiYHNDYzMhYVFAYjIiYHOAExNDYzMhYVOAExOAExFAYjIiY1OAExJzgBMTQ2MzIWFTgBMTgBMRQGIyImNTgBMQM4ATE0NjMyFhU4ATE4ATEUBiMiJjU4ATEHNDYzMhYVFAYjIibAJRsbJSUbGyWIJRsaJiYaGyVYEw0NExMNDRM4Ew0NExMNDROIEw0NExMNDROIEw0NExMNDRMQHBQUHBwUFBwsFQ8PFRUPDxUBoBslJRsbJSUdGiYmGhslJW0NExMNDRMTew0TEw0NExMrDRMTDQ0TEw04DRMTDQ0TEw0BEBQcHBQUHBwUiA8VFQ8PFRUAAgAQ//gCAAHYADoAcgAAJTQmJy4BJy4BJy4BByIGBw4BBw4BBw4BFxQWFx4BFx4BFx4BNzI2Nz4BNz4BNz4BNzoBMTI2NTwBNTEHDgEHDgEHDgEnIiYnLgEnLgEnLgE3NDY3PgE3PgE3PgEXMhYXHgEXHgEXHgEHMRwBFRQWFw4BBwIACwoKHRISKRcXMRgYMBYWKBEQGgkICQELCQkbEREnFRYtFxcsFRUlDxAYCAUGAgEBDRMzCRkPECUUFCoVFSoTEyMODhcHCAcBCQkIFw8OIhMSJxQUJhISHw4NFAcHBwERDAMIBeAZMRcXKRERGwkJCQELCgkcERIoFhcuGBguFRYmEBAZCAkIAQoJChoQECYUDRoNEw0BAQFVFCQPDhgHCAgBCggJGA8PIxQTKRQUKBMSIQ4OFgcHBwEJCAgWDg4hEhIlEwEBAQwSAQ4ZDAAAAAUAAP/gAgAB3gANABsAJAAsADsAADc0NjUnDgEVFBYXNy4BJRQGBxc+ATU0JicHFBYnHgEXNy4BJxUHPgE3NQ4BBwUOASMiJicHHgEzMjY3J2ABXAMCLCU5FBYBQBYUOSUsAgNcAYAiOBFdHGpCqxE4IkJqHAEqDyESEiEPORs+IiI+GzngBQkEHgwYDDdhI08VOB8fOBVPI2E3DBgMHgQJmAcpHh46TwhhTh4pB2EITzr/BwcHB04PEREPTgAAAAMAAP/gAgAB4AAbACcASgAAASIHDgEHBhUUFx4BFxYzMjc+ATc2NTQnLgEnJgcyFhUUBiMiJjU0NhMOASMiJicuATU0NjcXOAExBhQXHgEzMjY3NjQnNx4BFRQGAQA1Ly5GFBQUFEYuLzU1Ly5GFBQUFEYuLzU1S0s1NUtLzh9PKytPHx4hIR4iMTEYPSIiPRgxMSIeISEB4BQURi4vNTUvLkYUFBQURi4vNTUvLkYUFIBLNTVLSzU1S/7nHiEhHh9PKytPHyIxjDEYGRkYMYwxIh9PKytPAAIAAP/gAgAB4AAhAEMAAAEiBw4BBwYHNjc+ATc2MzIXHgEXFhUUFjMyNjU0Jy4BJyYDMjc+ATc2NwYHDgEHBiMiJy4BJyY1NCYjIgYVFBceARcWAQA0Li5GFBUBAREROCUmKismJjgREBwUFBwUFEYuLzU0Li5GFBUBAREROCUmKismJjgREBwUFBwUFEYuLwHgFBNELS40LSgoOxEREhE9KSkuFBwcFDUvLkYUFP4AFBNELS40LSgoOxEREhE9KSkuFBwcFDUvLkYUFAAAAAABAAD/4AIAAeAALQAAASM3LgEjIgYHDgEVFBYXHgEzMjY3PgE3Fw4BIyInLgEnJjU0Nz4BNzYzMhYXNwIAwEgbRyYmRxsbHR0bG0cmJkcbAgQCMSRjOjUvLkYUFBQURi4vNTVdI0sBIEgbHR0bG0cmJkcbGx0dGwMEAysoLxQURi4vNTUvLkYUFCgjSwAAAAAMAAj/7gHvAd4ADQAbAC0APwBQAGIAcACFAJcAqQC7AM0AAAEiJj0BNDYzMhYdARQGAyImPQE0NjMyFh0BFAYDIiYvASY2NzYWHwEWBgcOASMTIiYvASY2NzYWHwEWBgcOASMnIiYvAS4BNz4BHwEeAQcOAQUiJi8BLgE3PgEfAR4BBw4BIyUjIiY1NDY7ATIWFRQGJTgBMSMiJjU0NjM4ATEzMhYVFAYjBSImJyY2PwE2FhcWBg8BDgEjJSImJyY2PwE2FhcWBg8BDgEjAyImJy4BPwE+ARceAQ8BDgEjEyImJy4BPwE+ARceAQ8BDgEjAQAMEhIMDBISDAgLCwgICwtLBw0ELQYGCgoXBS0GBgoDCAOzBAgDLAQEBgYNBCwEBAYCBALkBAYDTgkGBgUVCU4JBgYDDQEwAgQCTQYDAwMMBk0GAwMCBwT+uFoKDg4KWgoODgFcWgYJCQZaBgkJBv5eBgoDBQUITggRBQUFCE4CBgMBNgQHAgMDBk0GDAMDAwZNAgQC5AMFAggEBC0EEQcHBQQtAwoFswIEAQYDAy0DDAUGAwMtAgcEAUgSDFoMEhIMWgwS/qYKCFoHCwsHWggKAUoIBk4KFgYGBgpOChYGAgL+1QUETQYOAwQEBk0GDgMCAfwCAiwGFQkJBgUtBhUJBgeoAQEtAwwFBgMDLQMMBQQEZw4KCg4OCgoOCQkGBgkJBgYJdwYFCBIELQUFCAgSBSwCAboEBAUMAy0DAwYFDAMtAQH+9gEBBRAHTgcFBQQQCE0FBQE7AQEDDAZNBgMDAwwGTQQEAAAAAQAAAAEAAAe3Z1NfDzz1AAsCAAAAAADckmTcAAAAANySZNwAAP/gAgAB4AAAAAgAAgAAAAAAAAABAAAB4P/gAAACAAAAAAACAAABAAAAAAAAAAAAAAAAAAAACwIAAAAAAAAAAAAAAAEAAAACAAAcAgAAEAIAAAACAAAAAgAAAAIAAAACAAAIAAAAAAAKABQAHgC2AWABwAIsApQC3AQKAAEAAAALAM4ADAAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAOAK4AAQAAAAAAAQAHAAAAAQAAAAAAAgAHAGAAAQAAAAAAAwAHADYAAQAAAAAABAAHAHUAAQAAAAAABQALABUAAQAAAAAABgAHAEsAAQAAAAAACgAaAIoAAwABBAkAAQAOAAcAAwABBAkAAgAOAGcAAwABBAkAAwAOAD0AAwABBAkABAAOAHwAAwABBAkABQAWACAAAwABBAkABgAOAFIAAwABBAkACgA0AKRpY29tb29uAGkAYwBvAG0AbwBvAG5WZXJzaW9uIDEuMABWAGUAcgBzAGkAbwBuACAAMQAuADBpY29tb29uAGkAYwBvAG0AbwBvAG5pY29tb29uAGkAYwBvAG0AbwBvAG5SZWd1bGFyAFIAZQBnAHUAbABhAHJpY29tb29uAGkAYwBvAG0AbwBvAG5Gb250IGdlbmVyYXRlZCBieSBJY29Nb29uLgBGAG8AbgB0ACAAZwBlAG4AZQByAGEAdABlAGQAIABiAHkAIABJAGMAbwBNAG8AbwBuAC4AAAADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA") format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: block;
    }

    [class^="icon-"], [class*=" icon-"] {
        font-family: 'icomoon';
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;

        /* Better Font Rendering =========== */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .icon-spinner:before {
        content: "\e000";
    }

    .icon-spinner-2:before {
        content: "\e001";
    }

    .icon-spinner-3:before {
        content: "\e002";
    }

    .icon-spinner-4:before {
        content: "\e003";
    }

    .icon-spinner-5:before {
        content: "\e004";
    }

    .icon-spinner-6:before {
        content: "\e005";
    }

    .icon-spinner-7:before {
        content: "\e006";
    }

    @keyframes anim-rotate {
        0% {
            transform: rotate(0);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .spinner {
        display: inline-block;
        font-size: 4em;
        height: 1em;
        line-height: 1;
        margin: .5em;
        animation: anim-rotate 2s infinite linear;
        color: #fff;
        text-shadow: 0 0 .25em rgba(255, 255, 255, .3);
    }

    .spinner--steps {
        animation: anim-rotate 1s infinite steps(8);
    }

    .spinner--steps2 {
        animation: anim-rotate 1s infinite steps(12);
    }

    body {
        font-family: sans-serif;
        color: #ccc;
        line-height: 1.5;
        font-size: 1em;
        background: #181818;
    }

    .talign-center {
        text-align: center;
    }

    a, a:visited {
        text-decoration: none;
        color: #444;
        text-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        transition: color .3s;
    }

    a:hover, a:active {
        color: #ccc;
    }
</style>
