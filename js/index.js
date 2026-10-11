$(document).ready(function () {
    const isLoggedIn = sessionStorage.getItem("isLoggedIn");
    const username = sessionStorage.getItem("username");

    if (isLoggedIn !== "true") {
        window.location.href = "login.html";
        return;
    }


    if (username) {
        const loginBtn = $("a[href='login.html']");
        
        
        loginBtn.replaceWith(`
            <div class="d-flex align-items-center gap-2">
                <span class="fw-bold text-danger">Welcome, ${username}!</span>
                <button id="logoutBtn" class="btn btn-outline-brand btn-sm">Logout</button>
            </div>
        `);
    }

    
    $(document).on("click", "#logoutBtn", function () {
        sessionStorage.clear();
        window.location.href = "login.html";
    });
});