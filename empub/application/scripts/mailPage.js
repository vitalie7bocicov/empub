window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });
    linkStatsAndSettingsButtons(cookies['mailID']);

    const inboxButton = document.getElementById('inboxButton');
    inboxButton.addEventListener('click', () => {
        const admin = localStorage.getItem('nimda');
       // console.log(admin);
        
        if(admin) {
            getMailUser(cookies['mailID']);
        }
        else {
            location.href = 'http://localhost/TehnologiiWeb/empub/public/main';
        }
    });

    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getEmailHtml = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailContentByID/${cookies['mailID']}`, {
            method: 'GET',
            headers: myHeaders
    });

    fetch(
        new Request(`http://localhost/TehnologiiWeb/statistics/statistics/updateStatisticsForMail/${cookies['mailID']}`,
        {method:'GET', headers:myHeaders})
    )
    .then((response) => {
        if(response.status != 200) {
            throw new TypeError (`Response with code ${response.status}`);
        }
        const contentType = response.headers.get('Content-Type');

        if(contentType && contentType.includes('application/json')) {
            //location.href = './home';
            return response.json();
        }
        
        throw new TypeError (`Not Json`);
    })
    .catch(err => {
        console.log(err);
    });

    
        fetch(getEmailHtml)
        .then((respose) => {
            if(respose.status != 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = respose.headers.get('Content-Type');
    
            if(contentType && contentType.includes('application/json')) {
                //location.href = './home';
                return respose.json();
            }
    
            throw new TypeError (`Not Json`);
        })
        .then(data => {
            const html = data.htmlText;
            const iframe = document.getElementById('iframe');
            const wrapper = document.getElementById('wrapper');
            const iframeDocument = iframe.contentDocument;
            const iframeWindow = iframe.contentWindow;


            const parser = new DOMParser();
            const parsedDocument = parser.parseFromString(html, 'text/html');
            const child = parsedDocument.documentElement;
            iframeDocument.replaceChild(child, iframeDocument.documentElement);


            wrapper.style.maxWidth = `${iframeDocument.body.scrollWidth + 50}px`;
            
            iframe.height = iframeDocument.body.scrollHeight + 30;
        })
    .catch(err => {
        console.log(err);
    });


}

function getMailUser(email) {
    const admin = localStorage.getItem('nimda');
    if(!admin) 
        return false;
    
        let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
        let myHeaders = new Headers();
        myHeaders.append('Authorization', authToken);
        let getEmailUser = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailUser/${email}`, {
                method: 'GET',
                headers: myHeaders
        });

        fetch(getEmailUser)
        .then((respose) => {
            if(respose.status != 200) {
                throw new TypeError (`Response with code ${response.status}`);
            }
            const contentType = respose.headers.get('Content-Type');
    
            if(contentType && contentType.includes('application/json')) {
                //location.href = './home';
                return respose.json();
            }
    
            throw new TypeError (`Not Json`);
        })
        .then(data => {
           if(data !== null) {
                location.href = `http://localhost/TehnologiiWeb/empub/public/main/${data.user}`;
           }
        })
    .catch(err => {
        console.log(err);
    });
}

function checkStatus(code){
    if(code==403)
        location.href="http://localhost/TehnologiiWeb/empub/public/";
}

function linkStatsAndSettingsButtons(id){
    const statsButton = document.getElementById("stats");

    statsButton.addEventListener("click",((event) => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/statistics/${id}`;
    }));

    const settingsButton = document.getElementById("settings");

    settingsButton.addEventListener("click",((event) => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/emailSettings/${id}`;
    }));
}