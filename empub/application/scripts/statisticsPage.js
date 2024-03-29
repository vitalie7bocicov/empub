window.onload = () => {
    let cookies = {};
    document.cookie.split(';').forEach(element => {
        let [key, value] = element.split('=');
        cookies[key.trim()] = value.trim();
    });
    linkSettingsButton(cookies['mailID']);
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
    let myHeaders = new Headers();
    myHeaders.append('Authorization', authToken);
    let getStatisticsHtml = new Request(`http://localhost/TehnologiiWeb/statistics/statistics/getMailStatisticsByMailID/${cookies['mailID']}`, {
            method: 'GET',
            headers: myHeaders
    });


    const inboxButton = document.getElementById('inboxButton');
    inboxButton.addEventListener('click', () => {
        const admin = localStorage.getItem('nimda');
        
        if(admin) {
            getMailUser(cookies['mailID']);
        }
        else {
            location.href = 'http://localhost/TehnologiiWeb/empub/public/main';
        }
    });

    var count = 1;
 
        fetch(getStatisticsHtml)
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
        .then(data => {

            const country = document.getElementById('country');
            const views = document.getElementById('views');
            const totalViews = document.getElementById('totalViews');

            var count2 = 1;

             data.country.forEach(element => {
                const td = document.createElement('td');
                td.innerText = element;
                td.id = count2;
                count2 = count2+1;
                country.append(td);
                country.append(" ");
            });
        
             var total = 0;
            data.viewDate.forEach(element => {
                const td1 = document.createElement('td');
                td1.innerText = element;
                td1.id = "view" + count;
                count = count+1;
                total = total + element;
                views.append(td1);
                views.append(" ");

           });

           totalViews.innerText = total;

        });


        day = document.getElementById('dayID');
        day.addEventListener("click",(event) =>{

            let getStatisticsForDay = new Request(`http://localhost/TehnologiiWeb/statistics/statistics/getStatisticsForDay/${cookies['mailID']}`, {
                method: 'GET',
                headers: myHeaders
        });
          
        fetch(getStatisticsForDay)
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
            const totalViews = document.getElementById('totalViews');
        
             var total = 0;
         
            for(i=1;i<count;i++){
              const views = document.getElementById(`view${i}`);

              if(data.viewDate[i-1]!=null){
               views.innerText=data.viewDate[i-1];
               total = total + data.viewDate[i-1];
              }
               else
               views.innerText = 0;

               
            }
           

           totalViews.innerText = total;

        });
        
          
        });

        
        week = document.getElementById('week');
        week.addEventListener("click",(event) =>{

            let getStatisticsForWeek = new Request(`http://localhost/TehnologiiWeb/statistics/statistics/getStatisticsForWeek/${cookies['mailID']}`, {
                method: 'GET',
                headers: myHeaders
        });
          
        fetch(getStatisticsForWeek)
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
        .then(data => {
            const totalViews = document.getElementById('totalViews');
        
             var total = 0;
         
            for(i=1;i<count;i++){
              const views = document.getElementById(`view${i}`);

              if(data.viewDate[i-1]!=null){
               views.innerText=data.viewDate[i-1];
               total = total + data.viewDate[i-1];
              }
               else
               views.innerText = 0;

               
            }
           

           totalViews.innerText = total;

        });
        });


        
        month = document.getElementById('month');
        month.addEventListener("click",(event) =>{

            let getStatisticsForMonth = new Request(`http://localhost/TehnologiiWeb/statistics/statistics/getStatisticsForMonth/${cookies['mailID']}`, {
                method: 'GET',
                headers: myHeaders
        });
          
        fetch(getStatisticsForMonth)
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
            const totalViews = document.getElementById('totalViews');
        
             var total = 0;
         
            for(i=1;i<count;i++){
              const views = document.getElementById(`view${i}`);

              if(data.viewDate[i-1]!=null){
               views.innerText=data.viewDate[i-1];
               total = total + data.viewDate[i-1];
              }
               else
               views.innerText = 0;

               
            }
           

           totalViews.innerText = total;

        });
        
          
        });


        const xmlBtn = document.getElementById('xmlBtn');

        xmlBtn.addEventListener('click', ()=>{
           var xmlDoc = document.implementation.createDocument("","statistics");
           var countries = xmlDoc.createElement("Countries");
           var views = xmlDoc.createElement("Views");

           for(i=1;i<count;i++){
            var countryNode = xmlDoc.createElement("country");
            const countriesHtml =  document.getElementById(i).innerText;
            countryNode.setAttribute("name",countriesHtml)
            countries.appendChild(countryNode);

            var viewNode = xmlDoc.createElement("view");
            const viewsHtml = document.getElementById(`view${i}`).innerText;
            viewNode.setAttribute("for",countriesHtml);
            viewNode.setAttribute("value",viewsHtml);
            views.appendChild(viewNode);
            
           }

           xmlDoc.documentElement.appendChild(countries);
           xmlDoc.documentElement.appendChild(views);

           var serializer = new XMLSerializer();
           
      

          window.open(window.URL.createObjectURL(new Blob([serializer.serializeToString(xmlDoc)],{type:'type/xml'})));
         
        });
        
       
}

function getMailUser(id) {
    
    let authToken = `Bearer ${localStorage.getItem('accessToken')}`;
        let myHeaders = new Headers();
        myHeaders.append('Authorization', authToken);
        let getEmailUser = new Request(`http://localhost/TehnologiiWeb/emails/mail/getMailUser/${id}`, {
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

function linkSettingsButton(id){
    
    const settingsButton = document.getElementById("settings");

    settingsButton.addEventListener("click",((event) => {
        location.href = `http://localhost/TehnologiiWeb/empub/public/emailSettings/${id}`;
    }));
}

