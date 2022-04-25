const msalconfig = {
    auth: {
        clientId: "dfb21e6e-2772-4972-8ba3-f68cbf20dbc0",
        authority: "https://login.microsoftonline.com/69f77188-635e-4aa6-8794-339171ab04f8",
        redirectUri: "https://wintergames.sd-lab.nl"
    },
    cache: {
        cacheLocation: "sessionStorage",
        storeAuthStateInCookie: false
    }
};

const MSALobj = new msal.PublicClientApplication(msalconfig);

async function inloggen() {

    const loginScope = {
        scopes: [ 'User.Read']
    };

    MSALobj.loginRedirect(loginScope);
}

MSALobj.handleRedirectPromise().then((response)=>{
    if(response!=null) {

        document.getElementById("overlay").style.display = "flex";
        document.getElementById("qrpopup").innerHTML = '<i id="Cross" class="fas fa-times" onclick="off()"></i>' + '<p id="qrText">Een moment geduld...</p><div class="loader"></div>';

        show(response.accessToken);
    }
}).catch((error)=>{
    document.getElementById("overlay").style.display = "flex";
    document.getElementById("qrpopup").innerHTML = '<i id="Cross" class="fas fa-times" onclick="off()"></i>' + '<p id="qrText">Het lijkt erop dat dit geen account van het GLR is...</p>'
});

async function show(token) {
    let req = await fetch("https://graph.microsoft.com/v1.0/me/", {
        headers: {
            "Authorization": "Bearer " + token
        }
    });

    let json = await req.json();

    let data = json.id + "+" + json.givenName + "+" + json.displayName + "+" + json.mail + "+" + json.jobTitle + "+" + json.officeLocation;

    var formData = new FormData();
    formData.append("gegevens", data);

    fetch("https://wintergames.sd-lab.nl/generateQR.php", {
        body: formData,
        method: "post",
    })
    .then(response => response.json())
    .then(data => {
        if (data.code) {
            document.getElementById("qrpopup").innerHTML = '<i id="Cross" class="fas fa-times" onclick="off()"></i>' +  '<div id="qr" style="display: none"></div><p id="qrText">Hey ' + json.givenName + '<p id="qrText">Dit is jouw QR code!</p>';
            document.getElementById("qr").style.display = "flex";
            document.getElementById("qr").style.backgroundImage = "url('" + 'https://wintergames.sd-lab.nl/' + data.code + "'" + ")";
            document.getElementById("qr").style.backgroundSize = "cover";
        } else {
            document.getElementById("qrpopup").innerHTML = '<i id="Cross" class="fas fa-times" onclick="off()"></i>' +  '<div id="qr" style="display: none"></div><p id="qrText">Sorry ' + json.givenName + ',</p><p>Aanvraag niet mogelijk.</p><p>Je bent geen crewlid.</p>';
            document.getElementById("qr").style.display = "flex";
            document.getElementById("qr").style.backgroundImage = "url('../media/kruis.png')";
            document.getElementById("qr").style.backgroundSize = "cover";
        }
    });
}