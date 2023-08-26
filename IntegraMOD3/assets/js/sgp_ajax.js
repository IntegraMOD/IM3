
/**
*
* @package sgp_ajax
* @version $Id: sgp_ajax.js 2008-07-10 21:16:00Z livewirestu $
* @copyright (c) 2008 phpbbireland
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Notes:
* This file makes use of prototype.js for some functions
* This file also uses php.js for unserialize function, which is a javascript equivalent of the php unserialize function
*/

var ajax_response_temp; // Used to make ajax response data globally available throughout page

function validateForm(the_form, func, container)
{
    var req_params = $(the_form).serialize(true);
    req_params.mode = 'validate_form';              // So the php file knows what to do
    req_params.func = func;                         // So the php file knows where to go
    req_params.form = the_form;                     // Just in case it is needed
    req_params.container = container;               // This is where the response ends up
       
    var sgp_aj_req = new Ajax.Request(
        'sgp_ajax.php',         // This is always our first port of call
        {
            method: 'get',
            parameters: req_params,
            onComplete: getResponse
        }
    );
}

function populateTable(func, params, action)
{
    var req_params = $(params).serialize(true);
    req_params.mode = 'populate_table';
    req_params.func = func;
    req_params.action = action;

    var sgp_aj_req = new Ajax.Request(
        'sgp_ajax.php',         // This is always our first port of call
        {
            method: 'get',
            parameters: req_params,
            onComplete: getResponse
        }
    );
}

function getResponse(oReq)
{  
    var resp = unserialize(oReq.responseText);
    // here we decide what we want to do with the stuff we received
    // The mode should be defined by the php function that was called
    switch(resp.mode)
    {
        case 'update_field':
            $(resp.container).innerHTML = resp.data;
        break;
        
        case 'update_form':
        
        break;
        
        case 'update_block':
            var ident = resp.data.identifier;
            for(var i in resp.data)
            {
                if(typeof(i) != "undefined" && i.match(ident))
                {
                    if($(i) != null)
                    {
                        var eltype = $(i).tagName;
                        switch(eltype)
                        {
                            // Add more cases here as we need them
                            case "INPUT":
                                $(i).value = resp.data[i];
                            break
                            
                            case "TD":
                                $(i).innerHTML = resp.data[i];
                            break;
                        }
                    }
                }
            }
        break;
        
        case 'provide_data':
            ajax_response_temp = resp;  // Put the response in a global var so we can get at it elsewhere
        break;
        
        default:
        
        break;
    
    }
}