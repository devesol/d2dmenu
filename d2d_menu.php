<!DOCTYPE html>
<html>
    <head>
        <style>
            td {border: 1px black solid;}
            #add {width: 20px;}
        </style>
        <meta charset="utf-8" />
        <title>Clone</title>
        <script>
            function checkDuplicates() {
                var arrayTmp = [];
                var browseSelect = getArrayOfOptionUsed();
                console.log("1 : " + arrayTmp);
                for (i = 0; i < browseSelect.length; i++) {
                    if (arrayTmp.indexOf(browseSelect[i]) === -1) {
                        console.log();
                        arrayTmp.push(browseSelect[i]);
                    } else {
                        alert("Vous avez rentré deux fois la même valeur");
                    }
                }
                console.log("2 : " + arrayTmp);
            }
            function getValues() {
                var arraySearch = document.getElementsByClassName('inputSearch');
                var arraySelect = document.getElementsByClassName('selectCriteria');
                var i;
                var valueToReturn = "?";
                for (i = 0; i < arraySearch.length; i++) {
                    valueToReturn += "&" + arraySelect[i].value + "=" + arraySearch[i].value;
                }
                return valueToReturn;

            }
            function setButtonDeleteVisibleIfMoreLastOne() {
                var arrayButtonDeleteClass = document.getElementsByClassName('deleteTrClone');
                var whichDisplay = "none";
                var i;
                if (arrayButtonDeleteClass.length > 1) {
                    var whichDisplay = "inline";
                }
                for (i = 0; i < arrayButtonDeleteClass.length; i++) {
                    arrayButtonDeleteClass[i].style.display = whichDisplay;
                }
            }
            function setButtonDeletePosition() {
                var arrayButtonDeleteClass = document.getElementsByClassName('deleteTrClone');
                var i;
                for (i = 0; i < arrayButtonDeleteClass.length; i++) {
                    arrayButtonDeleteClass[i].setAttribute("position", i);
                }
            }

            function setButtonDeleteProperty() {
                setButtonDeleteVisibleIfMoreLastOne();
                setButtonDeletePosition();
            }

            function deleteClone(whichElt) {
                //var whichNodeToRemove = whichElt.parentNode.parentNode;
                var whichPostion = whichElt.getAttribute("position");
                var whichNodeToRemove = document.getElementsByClassName('originalTr')[whichPostion];
                whichNodeToRemove.parentNode.removeChild(whichNodeToRemove);
                setButtonDeleteProperty();
            }
            function getValueOfFirstEltOfOriginalArrayAvailable() {
                var valueToReturn = '';
                var i;
                var arrayListOfItemsInSelect = getArrayListOfItemsInSelect();
                for (i = 0; i < arrayListOfItemsInSelect.length; i++) {
                    var valueToTest = arrayListOfItemsInSelect[i].value;
                    if (valueToReturn === '') {
                        if (isAlreadyUsed(valueToTest)) {
                            valueToReturn = valueToTest;
                        }
                    }
                }
                return valueToReturn;
            }
            function isAlreadyUsed(str) {
                boolToReturn = false;
                if (getArrayOfOptionUsed().indexOf(str) === -1) {
                    boolToReturn = true;
                }
                return boolToReturn;
            }
            function getArrayListOfItemsInSelect() {
                return document.getElementById('selectCriteria').getElementsByClassName('option');
            }
            function getArrayOfOptionUsed() {
                var i;
                var arrayToReturn = [];
                var arrayOfSelectCriteria = document.getElementsByClassName('selectCriteria');
                for (i = 0; i < arrayOfSelectCriteria.length; i++) {
                    if (arrayOfSelectCriteria[i].value !== '') {
                        arrayToReturn.push(arrayOfSelectCriteria[i].value);
                    }
                }
                return arrayToReturn;
            }
            function cloneOriginalTr() {
                var originalTr = document.getElementById('originalTr');
                if (getNbClonedElements() < getNbOptionInSelect()) {
                    var cloneTr = originalTr.cloneNode(true);
                    document.getElementById('parentTable').appendChild(cloneTr);
                    setButtonDeleteProperty();
                    arraySelectCriteria = document.getElementsByClassName('selectCriteria');
                    arraySelectCriteria[getNbClonedElements() - 1].value = '';
                    arraySelectCriteria[getNbClonedElements() - 1].value = getValueOfFirstEltOfOriginalArrayAvailable();
                    arrayInputSearch = document.getElementsByClassName('inputSearch');
                    arrayInputSearch[getNbClonedElements() - 1 ].value = '';
                }
            }
            function getNbOptionInSelect() {
                var nodeRecherche = document.getElementById('selectCriteria');
                var nbOptionsInRecherche = nodeRecherche.childElementCount;
                return nbOptionsInRecherche;
            }
            function getNbClonedElements() {
                var nodeParentTable = document.getElementById('parentTable');
                var nbEltsInParentTable = nodeParentTable.childElementCount;
                return nbEltsInParentTable;
            }
            function duplicateMuchClone() {
                var i;
                for (i = 0; i < getNbOptionInSelect(); i++) {
                    cloneOriginalTr();
                }
            }
        </script>
    </head>
    <body>
        <form>
            <table id="parentTable">
                <tr id="originalTr"  class="originalTr">
                    <td>
                        <input id="inputSearch" class="inputSearch" type="text" />
                    </td>
                    <td>
                        <select name=selectCriteria id="selectCriteria" class="selectCriteria" onclick="getNbOptionInSelect();">
                            <option value="num_po" class="option">PO#</option>
                            <option value="sku_id"   class="option">SKU#</option>
                            <option value="dpt" class="option">Dpt</option>
                            <option value="qc_num" class="option">QC#</option>
                            <option value="pol" class="option">POL</option>
                            <option value="pod" class="option">POD</option>
                        </select>
                    </td>
                    <td>
                        <img src="vert.png" id="add" onclick="cloneOriginalTr();"/>
                    </td>
                    <td>
                        <img src="rouge.png" style="display: none;" onclick="deleteClone(this); return false;" class="deleteTrClone"/>
                    </td>
                    <td>
                        <img src="button_add.png" onclick="duplicateMuchClone();
                                return false;" id="add"/>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                <tr>
                    <td colspan="100">
                        <button onclick="alert(getValues()); return false;">Envoyer le resultat</button>
                        <button onclick="checkDuplicates(); return false;">Controle des doublons</button>
                    </td>
                </tr>

                </tr>
            </table>
        </form>

        <script>
            //console.log(setButtonIfMoreLastOne());
        </script>

    </body>
    <!--disabled-->
</html>
