<div class="footer">
    <div class="copyright">
        <p>Copyright © {{ date('Y') }} Designed & Developed by <a href="#" target="_blank">Quixkit</a></p>
    </div>
</div>

<style>
    .content-body {
        min-height: calc(100vh - 150px);
        /* Sesuaikan 150px dengan tinggi header + footer */
        display: flex;
        flex-direction: column;
    }

    .container-fluid {
        flex-grow: 1;
    }

    .footer {
        position: relative;
        z-index: 1;
        background: #f8f9fa;
        text-align: center;
        padding: 10px 0;
        width: 100%;
        margin-top: auto
    }
</style>
