
window.snapKitInit = () => {
    snap.loginkit.mountButton("sc-login-button", {
        clientId: "01982933-eeb0-48bb-98e0-5eaf132552b1",
        redirectURI: "https://laralab.manzhos.cz",
        scopeList: [
            "user.display_name",
            "user.bitmoji.avatar",
        ],
        handleResponseCallback: () => {
            snap.loginkit.fetchUserInfo().then(data => {
                document.getElementById("sc-login-button").classList.add("sc-hidden")
                document.getElementById("sc-profile").classList.remove("sc-hidden")

                document.getElementById("sc-picture").src = data["data"]["me"]["bitmoji"]["avatar"]
                document.getElementById("sc-welcome").innerHTML = "Welcome, " + data["data"]["me"]["displayName"] + "!"
            })
        },
    })
}

// Load the SDK asynchronously
(function (d, s, id) {
    var js, sjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://sdk.snapkit.com/js/v1/login.js";
    sjs.parentNode.insertBefore(js, sjs);
}(document, "script", "loginkit-sdk"));
