//Source: http://javascript.about.com/library/bldom08.htm
//Returns an array of elements having the passed
//class name.
//Param: cl - string name of the class to list.
document.getElementsByClassName = function(cl) {
var retnode = [];
var myclass = new RegExp('\\b'+cl+'\\b');
var elem = this.getElementsByTagName('*');
for (var i = 0; i < elem.length; i++) {
var classes = elem[i].className;
if (myclass.test(classes)) retnode.push(elem[i]);
}
return retnode;
};