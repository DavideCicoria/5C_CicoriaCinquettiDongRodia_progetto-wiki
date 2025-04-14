export const generateAdminTable = (parentElement) => { // parentElement,pubsub
    let header = [];
    let data = [];
    let callbacks = {} ;

    const tableObject = {
        build: function(inputHeader, inputData, callbackUpdate, callbackDownload, callbackDelete) {
            header = inputHeader;
            data = inputData;
            callbacks[update]=callbackUpdate;
            callbacks[download]=callbackDownload;
            callbacks[remove]=callbackDelete;
            this.setData(callbacks.download())
            /*
            pubsub.subscribe("get-remote-data",(remoteData)=>{
                this.setData(remoteData);
                this.render();
            })
            */
        },
        render: function() {
            let html = '<table class="table table-focus table-striped"><thead class="sticky-on-top"><tr>';
            
            header.forEach(e => {
                html += '<th class="table-secondary">' + e + "</th>";
            });
            html += "</tr></thead><tbody>";

            let dataKeys = Object.keys(data);

            dataKeys.forEach(e => {
                html += '<tr><td><a href="#wiki-' + e.replaceAll(" ", "-") + '"id="' + e + '" class="wikiLink">' + e + ' <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td><td><button type="button" id="edit-' + e + '" class="btn btn-warning editButton" data-bs-toggle="modal" data-bs-target="#modalForm"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td></tr>';
            });
            /*
            dataKeys.forEach(e => {
                html += '<tr><td><a href="#wiki-' + e.replaceAll(" ", "-") + '"id="' + e + '" class="wikiLink">' + e + ' <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td><td><button type="button" id="edit-' + e + '" class="btn btn-warning editButton" data-bs-toggle="modal" data-bs-target="#modalForm"><i class="fa-solid fa-pen-to-square"></i> Edit</button> <button type="button" id="delete-' + e + '" class="btn btn-danger deleteButton"><i class="fa-solid fa-trash"></i> Delete</button></td></tr>';
            });
            */

            html += "</tbody></table>";
            parentElement.innerHTML = html;

            document.querySelectorAll(".editButton").forEach( (button,index) => {
                button.onclick = () => {
                    callbacks.update()
                    this.setData(callbacks.download())
                    //impostare i comandi server prima di proseguire
                };
            });

            document.querySelectorAll(".deleteButton").forEach((button,index) => {
                button.onclick = () => {
                    callbacks.remove(index)
                    this.setData(callbacks.download())
                    //pubsub.publish("el-deleted", data);
                };
            });
        },
        setData: function(inputData) {
            data = inputData;
        },
        getData: function() {
            return data;
        }
    };
    return tableObject;
};