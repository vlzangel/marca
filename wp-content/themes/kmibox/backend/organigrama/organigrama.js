  function init() {
    var $ = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
      $(go.Diagram, "myDiagramDiv", // must be the ID or reference to div
        {
          initialContentAlignment: go.Spot.Center,
          // make sure users can only create trees
          validCycle: go.Diagram.CycleDestinationTree,
          // users can select only one part at a time
          maxSelectionCount: 1,
          layout:
            $(go.TreeLayout,
              {
                treeStyle: go.TreeLayout.StyleLastParents,
                arrangement: go.TreeLayout.ArrangementHorizontal,
                // properties for most of the tree:
                angle: 90,
                layerSpacing: 35,
                // properties for the "last parents":
                alternateAngle: 0,
                alternateLayerSpacing: 35,
                alternateAlignment: go.TreeLayout.AlignmentStart,
                alternateNodeIndent: 10,
                alternateNodeIndentPastParent: 1.0,
                alternateNodeSpacing: 10,
                alternateLayerSpacing: 30,
                alternateLayerSpacingParentOverlap: 1.0,
                alternatePortSpot: new go.Spot(0.01, 1, 10, 0),
                alternateChildPortSpot: go.Spot.Left
              }),
          // enable undo & redo
          "undoManager.isEnabled": false  
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    /*  
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });
    */

    var graygrad = $(go.Brush, "Linear",
      { 0: "rgb(195, 251, 200)", 0.5: "rgb(176, 252, 183)", 1: "rgb(125, 250, 136)" });

    // when a node is double-clicked, add a child to it
    function nodeDoubleClick(e, obj) {
     
    }

    // this is used to determine feedback during drags
    function mayWorkFor(node1, node2) {
      if (!(node1 instanceof go.Node)) return false;  // must be a Node
      if (node1 === node2) return false;  // cannot work for yourself
      if (node2.isInTreeOf(node1)) return false;  // cannot work for someone who works for you
      return true;
    }

    // This function provides a common style for most of the TextBlocks.
    // Some of these values may be overridden in a particular TextBlock.
    function textStyle() {
      return { font: "9pt sans-serif", stroke: "black" };
    }

    // define the Node template
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        // for sorting, have the Node.text be the data.name
        new go.Binding("text", "name"),
        // bind the Part.layerName to control the Node's layer depending on whether it isSelected
        new go.Binding("layerName", "isSelected", function(sel) { return sel ? "Foreground" : ""; }).ofObject(),
        // define the node's outer shape
        $(go.Shape, "RoundedRectangle",
          {
            name: "SHAPE",
            fill: graygrad, stroke: "green",
            portId: "", fromLinkable: true, toLinkable: true, cursor: "pointer"
          }),
        // define the panel where the text will appear
        $(go.Panel, "Table",
          {
            maxSize: new go.Size(150, 999),
            margin: new go.Margin(3, 3, 0, 3),
            defaultAlignment: go.Spot.Left
          },
          $(go.RowColumnDefinition, { column: 2, width: 4 }),
          $(go.TextBlock,  // the name
            {
              row: 0, column: 0, columnSpan: 5,
              font: "bold 9pt sans-serif",
              editable: true, isMultiline: false,
              stroke: "black", minSize: new go.Size(10, 14)
            },
            new go.Binding("text", "name").makeTwoWay()),
          $(go.TextBlock, textStyle(),
            {
              row: 1, column: 1, columnSpan: 4,
              editable: true, isMultiline: false,
              minSize: new go.Size(10, 14),
              margin: new go.Margin(0, 0, 0, 3)
            },
            new go.Binding("text", "title").makeTwoWay()),
          $(go.TextBlock, "Cod.: ", textStyle(),  // the ID and the boss
            { row: 2, column: 0 }),
          $(go.TextBlock, textStyle(),
            { row: 2, column: 1 },
            new go.Binding("text", "key")),
          $(go.TextBlock, textStyle(),
            { row: 2, column: 4, },
            new go.Binding("text", "parent")),
          $(go.TextBlock,  // the comments
            {
              row: 3, column: 0, columnSpan: 5,
              font: "italic 9pt sans-serif",
              wrap: go.TextBlock.WrapFit,
              editable: true,  // by default newlines are allowed
              stroke: "black",
              minSize: new go.Size(10, 14)
            },
            new go.Binding("text", "comments").makeTwoWay()),
          $("TreeExpanderButton",
            { row: 4, columnSpan: 99, alignment: go.Spot.Center })
        )  // end Table Panel
      );  // end Node

    // define the Link template
    myDiagram.linkTemplate =
      $(go.Link, go.Link.Orthogonal,
        { corner: 5, relinkableFrom: true, relinkableTo: true },
        $(go.Shape, { strokeWidth: 2 }));  // the link shape

    // read in the JSON-format data from the "mySavedModel" element
    load();
  }

 
  function load() {

    var data = '';

    jQuery.post(
      TEMA+"/backend/organigrama/ajax/organigrama.php",
      {}, 
      function(datos){
          if( datos != "" ){
            myDiagram.model = go.Model.fromJson(datos);
            myDiagram.isModified = false; 
          }
      }, "json"
    );
  
  }

  $(function(){
    $(window).load(function(){
      init();
      load();
    })
  });