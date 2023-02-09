<?php

class TableauSQL
{
    private $tableau;
    private $bdd;
    private $table;
    private $order;
    
    public function __construct($tableau, $bdd, $table, $order)
    {
        $this->tableau = $tableau;
        $this->bdd = $bdd;
        $this->table = $table;
        $this->order = $order;
    }
    
    public function afficher()
    {
        $list_champs = $this->tableau->getChamps();
        $sql = "SELECT " . $list_champs . " 
                FROM " . $this->table . "
                ORDER BY " . $this->order;
                     
        $reponse = $this->bdd->query($sql);
        
        ?>
        
        <form class="list-selection">
        </form>
        
        <table class="list nowrap">
            <tbody>
                <tr>
                    <?php
                        echo $this->tableau->getTitres();
                    ?>
                </tr>
                <?php
                    while($donnees = $reponse->fetch())
                    {
                        echo '<tr>';
                            echo $this->tableau->getLigne($donnees);
                        echo '</tr>';
                    }
                ?>
            <tbody>
        </table>
        <?php
        $reponse->closeCursor();
        
        
        if($this->tableau->haveHideColumn())
        {
            ?>
            <script type="text/javascript">
                InitList();
            
                function InitList()
                {
                    var listForm = document.getElementsByClassName("list-selection");
                    var listTable = document.getElementsByClassName("list");
                    
                    for(var i = 0; i < listTable.length; i++)
                    {
                        var elemForm = listForm[i];
                        var elemSelect = document.createElement("select");
                        var elemButton = document.createElement("input");
                        
                        elemSelect.setAttribute("style", "width: 300px; margin-right: 20px;");
                        
                        elemButton.setAttribute("type", "submit");
                        elemButton.setAttribute("value", "Ajouter");
                        
                        elemForm.setAttribute("action", "javascript:ModifList('add', " + i + ", 0)");
                        elemForm.appendChild(elemSelect);
                        elemForm.appendChild(elemButton);
                        
                        ModifList("format", i, 0);
                    }
                }
                
                function ModifList(action, table, column)
                {
                    var listTable = document.getElementsByClassName("list");
                    var listForm = document.getElementsByClassName("list-selection");
                    var listLine = listTable[table].querySelectorAll("tr");
                    var elemSelect = listForm[table].querySelectorAll("select")[0];
                    
                    if(action == "add")
                    {
                        var indexSelect = elemSelect.selectedIndex;
                        if(indexSelect != -1)
                        {
                            var elemOption = elemSelect.querySelectorAll("option")[indexSelect];
                            column = elemOption.getAttribute("value");
                            elemSelect.removeChild(elemOption);
                        }
                    }
                    else if(action == "remove")
                    {
                        var elemTitle = listLine[0].querySelectorAll("th")[column];
                        var elemOption = document.createElement("option");
                        elemOption.setAttribute("value", column);
                        elemOption.textContent = elemTitle.childNodes[0].childNodes[0].textContent;
                        elemSelect.insertBefore(elemOption, elemSelect.firstChild);
                        elemSelect.selectedIndex = 0;
                        
                    }
                    
                    for(var j = 0; j < listLine.length; j++)
                    {
                        if(action == "format")
                        {
                            var listTitle = listLine[j].querySelectorAll("th");
                            
                            for(var k = 0; k < listTitle.length; k++)
                            {
                                var elemTitle = listTitle[k];
                                var elemLink = document.createElement("a");
                                elemLink.setAttribute("href", "javascript:ModifList('remove', " + table + ", " + k + ")");
                                elemLink.setAttribute("title", "Retirer la colonne");
                                elemLink.appendChild(document.createTextNode("-"));
                                elemTitle.appendChild(elemLink);
                                
                                if(listTitle[k].hasAttribute("style"))
                                {
                                    var elemOption = document.createElement("option");
                                    elemOption.setAttribute("value", k);
                                    elemOption.textContent = elemTitle.childNodes[0].childNodes[0].textContent;
                                    elemSelect.appendChild(elemOption);
                                }
                            }
                        }
                        
                        if(action == "add" || action == "remove")
                        {
                            var listCell = listLine[j].querySelectorAll("th, td");
                            
                            if(action == "add" && listCell[column].hasAttribute("style"))
                                listCell[column].removeAttribute("style");
                            else if(action == "remove")
                                listCell[column].setAttribute("style", "display: none;");
                        }
                    }
                }
            </script>

            <?php
        }
    }
}

?>