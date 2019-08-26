<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>iCal-like Calendar (CSS+jQuery)</title>
		<link rel="stylesheet" href="master.css" type="text/css" media="screen" charset="utf-8" />
		<script src="coda.js" type="text/javascript"> </script>
	</head>
	<body>
		<h1>iCal-like Calendar Demo</h1>
		<table cellspacing="0" class="full-calendar">
			<thead>
				<tr><th>M</th><th>T</th><th>W</th><th>TH</th><th>F</th><th>S</th><th>S</th></tr>
			</thead>
			<tbody>
				<tr>
					<td class="padding" colspan="3"></td>
					<td> 1</td>
					<td> 2</td>
					<td> 3</td>
					<td> 4</td>
				</tr>
				<tr>
					<td> 5</td>
					<td> 6</td>
					<td> 7</td>
					<td> 8</td>
					<td> 9</td>
					<td>10</td>
					<td>11</td>
				</tr>
				<tr>
					<td>12</td>
					<td class="date_has_event">13</td>
					<td>14</td>
					<td>15</td>
					<td>16</td>
					<td>17</td>
					<td>18</td>
				</tr>
				<tr>
					<td>19</td>
					<td>20</td>
					<td>21</td>
					<td class="date_has_event">22</td>
					<td>23</td>
					<td>24</td>
					<td>25</td>
				</tr>	
				<tr>
					<td>26</td>
					<td>27</td>
					<td>28</td>
					<td>29</td>
					<td>30</td>
					<td>31</td>
					<td class="padding"></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>