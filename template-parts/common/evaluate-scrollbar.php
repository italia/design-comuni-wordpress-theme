<script>
    const scrollDemo = document.querySelector("#scrollDemo");
    const progressBar = document.querySelector(".progress-bar");

    let percentage;
            
    document.addEventListener("scroll", event => {
        percentage = 100 * window.pageYOffset / scrollDemo.offsetHeight;
        progressBar.setAttribute('style',`width: ${percentage}%`);
        progressBar.setAttribute('aria-valuenow',`${percentage}`);
    });
</script>