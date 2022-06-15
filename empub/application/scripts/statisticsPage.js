window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });

    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getStatisticsHtml = new Request(`http://localhost/TehnologiiWeb/statistics/statistics/getMailStatisticsByMailID/${cookies['mailID']}`, {
            method: 'GET',
            headers: myHeaders
    });
 
        fetch(getStatisticsHtml)
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
            const country = document.getElementById('country');
            const views = document.getElementById('views');
            const totalViews = document.getElementById('totalViews');

             data.country.forEach(element => {
                const td = document.createElement('td');
                td.innerText = element;
                country.append(td);
                country.append(" ");
            });
        
             var total = 0;
            data.viewDate.forEach(element => {
                const td1 = document.createElement('td');
                td1.innerText = element;
                total = total + element;
                views.append(td1);
                views.append(" ");

           });

           totalViews.innerText = total;

        });

}