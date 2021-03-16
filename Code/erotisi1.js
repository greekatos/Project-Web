document.getElementById("logo").onclick = function () {
	
	
	
	//variables
	var serverIPAddresss ;//entries
	var WaitTimings,startedDateTimee = "";//entries
	var method,url = "";//request
	var status = 0;//response
	var statusText="";//response
	var headersRespp,headersReqq,headersResp,headersReq="";
	
	
	//arrays
	var urls=[];
	var headerR=[];
	var headerRe=[];
	var FINAL_entries = [];
	var FINAL_response = [];
	var FINAL_request = [];
	var FINAL = [];
	
	//objects
	let FINALL = {};
	let header = {};
	
	
	
	
	const fileselector = document.getElementById('logo')
	
	fileselector.addEventListener('change', function() { 
		
		
		var fr=new FileReader(); 
		const read=fr.readAsText(fileselector.files[0]);
		
		fr.onload=function(e){  //Explain what onlaod does    		
			const obj = JSON.parse(e.currentTarget.result); 
			console.log (obj);
			
			
			
			
			var count =0;//Counts the entries in the obj
			for (var i in obj.log.entries){
				count++;		
			}
			
			
			
			//function for url domain
			const getHostname = (url) => {
				url = new URL(url).hostname;					
				return url;
			}
			
			
			//Function to check all the Response Header types
			function checkHeadersResponse(headersResp,json_obj){
				
				
				//Response
				for(j=0; j<Rlength;j++){
					
					
					
					if(headersResp.headers[j].name.toLowerCase() === "content-type"){
						
						json_obj.push(headersResp.headers[j]);
						
					}
					else if(headersResp.headers[j].name.toLowerCase() === "cache-control"){	
						
						json_obj.push(headersResp.headers[j]);
						
					}
					else if(headersResp.headers[j].name.toLowerCase() === "pragma"){
						
						json_obj.push(headersResp.headers[j]);
					}
					else if(headersResp.headers[j].name.toLowerCase() === "expires"){
						
						json_obj.push(headersResp.headers[j]);
					}
					else if(headersResp.headers[j].name.toLowerCase() === "age"){
						
						json_obj.push(headersResp.headers[j]);
						
					}
					else if(headersResp.headers[j].name.toLowerCase() === "last-modified"){
						
						json_obj.push(headersResp.headers[j]);
						
					}
				}	
			}
			
			
			//Function to check all the Request Header types			
			function checkHeadersRequest(headersReq,json_obj){
				for(j=0; j<Reqlength;j++){
					
					
					
					if(headersReq.headers[j].name.toLowerCase() === "content-type"){
						
						json_obj.push(headersReq.headers[j]);
						
					}
					else if(headersReq.headers[j].name.toLowerCase() === "cache-control"){	
						
						json_obj.push(headersReq.headers[j]);
						
					}
					else if(headersReq.headers[j].name.toLowerCase() === "pragma"){
						
						json_obj.push(headersReq.headers[j]);
					}
					else if(headersReq.headers[j].name.toLowerCase() === "host"){
						
						json_obj.push(headersReq.headers[j]);
						
					}
				}	
			}
			
			
			
			
			
			
			
			for (var i in obj.log.entries){
				var json_entries = {};
				let json_response = {};
				let json_request = {};
				
				Rlength = obj.log.entries[i].response.headers.length; // The length of the Response Headers array
				Reqlength = obj.log.entries[i].request.headers.length;// The length of the Request Headers array
				
				
				
				
				//variables
				serverIPAddresss= obj.log.entries[i].serverIPAddress;
				WaitTimings = obj.log.entries[i].timings.wait;
				startedDateTimee = obj.log.entries[i].startedDateTime;
				method = obj.log.entries[i].request.method;
				status = obj.log.entries[i].response.status;
				statusText=obj.log.entries[i].response.statusText;
				url = obj.log.entries[i].request.url;
				headersRespp=obj.log.entries[i].response;
				headersReqq=obj.log.entries[i].request;
				
				
				
				json_entries.serverIPAddresss = serverIPAddresss;
				json_entries.waitTimings = WaitTimings;
				json_entries.startedDateTimee = startedDateTimee;
				
				json_entries.response = {};
				json_entries.response.StatusResult = status;
				json_entries.response.StatusTextResult = statusText;
				json_entries.response.header=[];
				checkHeadersResponse(headersRespp,json_entries.response.header);
				
				json_entries.request = {};
				json_entries.request.methods = method;
				json_entries.request.url = getHostname(url);
				json_entries.request.header=[];
				checkHeadersRequest(headersReqq,json_entries.request.header);
				
				/*json_response.StatusResult = status;
				json_response.StatusTextResult = statusText;
				json_response.header=[];
				checkHeadersResponse(headersRespp,json_response.header);
				
				json_request.methods = method;
				json_request.url = getHostname(url);
				json_request.headerr=[];
				checkHeadersRequest(headersReqq,json_request.headerr);*/
				
				
				
				
				
				FINAL_entries.push(json_entries);
				//FINAL_response.push(json_response);
				//FINAL_request.push(json_request);
				
				
				
					
				
			}
			
			
			//Unify JSON Objects
			
			FINALL ={ FINAL_entries
			}
			
			console.log(FINALL);
			
			
			
			
			
			
			
			
			var JSONHarString = JSON. stringify(FINALL,null,2);
			localStorage.setItem("myValue",JSONHarString);
			window.location.href="newfile.html";
		}
		
		
		
		
		
	}
	
	)
	
}