//
// @mod package		Download MOD 6
// @file			ajax_dl.js 1 2011/08/18 OXPUS
// @copyright		(c) 2011 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
// @license			http://opensource.org/licenses/gpl-license.php GNU Public License
//

//
// Inline search
//
function AJAXDLVote(df_id, points)
{
	if (!ajax_core_defined)
	{
		return;
	}

	var url	= 'downloads.' + phpEx;
	var params = 'view=ajax&df_id=' + df_id + '&rate_point=' + points;

	if (S_SID != '')
	{
		params += '&sid='+S_SID;
	}

	if (!loadXMLDoc(url, params, 'dl_rate_change'))
	{
		AJAXDLFinishRate(0, 0, 0);
	}
}

function dl_rate_change()
{
	if (!ajax_core_defined)
	{
		return;
	}

	if (request.readyState == 4)
	{
		var rating_img = '';
		var results = 0;
		var df_id = 0;
		if (request.status == 200)
		{
			response = request.responseXML.documentElement;

			if (response != null)
			{
				rating_img = getFirstTagValue('rating_img', response);
				df_id = getFirstTagValue('df_id', response);
				result = getFirstTagValue('result', response);
			}
		}

		AJAXDLFinishRate(rating_img, df_id, result);
	}
}

function AJAXDLFinishRate(rating_img, df_id, result)
{
	if (!ajax_core_defined)
	{
		return;
	}

	var rating = getElementById('rating_' + df_id);

	if (rating_img == null || rating == null)
	{
		return;
	}

	if (result == AJAX_POLL_RESULT)
	{
		rating.innerHTML = rating_img;
	}
}