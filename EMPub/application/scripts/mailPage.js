window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
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
        console.log(data.id);
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
            
            console.log(iframeDocument.body.scrollWidth);

            wrapper.style.maxWidth = `${iframeDocument.body.scrollWidth + 50}px`;
            console.log(wrapper.style.maxWidth);
            
            iframe.height = iframeDocument.body.scrollHeight + 30;
        });


}

function checkStatus(code){
    if(code==403)
        location.href="http://localhost/TehnologiiWeb/empub/public/";
}