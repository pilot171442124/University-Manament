
function isNormalChart(pChartType){
	var retFlag = 0;
	switch(pChartType) {
		case "pie":
			retFlag = 1;
			break;
		case "column":
			retFlag = 1;
			break;
		case "bar":
			retFlag = 1;
			break;
		case "singleline":
			retFlag = 1;
			break;
		case "singlearea":
			retFlag = 1;
			break;
		default:
			retFlag = 0;
	}
	return retFlag;
}


function isComplexChart(pChartType){
	var retFlag = 0;
	switch(pChartType) {
		case "combinecolumn":
			retFlag = 1;
			break;
		case "combinebar":
			retFlag = 1;
			break;
		case "stackcolumn":
			retFlag = 1;
			break;
		case "stackbar":
			retFlag = 1;
			break;
		case "stackcolumnpercent":
			retFlag = 1;
			break;
		case "stackbarpercent":
			retFlag = 1;
			break;
		case "multiline":
			retFlag = 1;
			break;
		case "multiarea":
			retFlag = 1;
			break;
		default:
			retFlag = 0;
	}

	return retFlag;
}