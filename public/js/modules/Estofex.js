export class Estofex{
    constructor(){}

    static async GetPage(uri){
        const data = await fetch(uri);
        const html = await data.text();
        
        if (html == null || html.length < 1){
            console.log('[ERROR] could not retrieve html');
        }

        return html;
    }

    static async GetWarnings(showOnlyValid){
        const uri = 'https://www.estofex.org/cgi-bin/polygon/showforecast.cgi?list=yes';

        if (showOnlyValid){
            uri = 'https://www.estofex.org/cgi-bin/polygon/showforecast.cgi?listValid=yes';
        }

        const page = await this.GetPage(uri);
    }
}