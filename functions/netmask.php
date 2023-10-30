<?php
	//载入页头
	include_once("./template/header.php")
?>
    <!--面包屑导航-->
	<div id="navigation" class = "layui-hide-xs">
		<div class="layui-container">
			<div class="layui-row">
				<div class="layui-col-lg12">
					<p>
						当前位置：<a href="./?c=netmask">子网掩码</a> 
						<!--遍历导航-->
						<?php foreach( $navigation as $menu )
						{
							$menu = con_coding($menu);
							$remenu = $remenu.'/'.$menu;
							
							if($remenu == '/'){
								$remenu = $menu;
							}
						?>
						
						<a href="./?dir=<?php echo $remenu; ?>"><?php echo $menu; ?></a> / 
						<?php } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
    <!--面包屑导航END-->
	<div id="list">
		<div class="layui-container">
		  	<div class="layui-row">
		    	<div align="center" class="layui-col-lg12">
			    	<table class="layui-table" lay-skin="line">
			    	    <colgroup>
					    <col width="auto">
					    <col>
					  </colgroup>
					  					  <thead>
					    <tr>
					      <th>网络和IP地址计算器</th>
					    </tr> 
					  </thead>
					  <style>
							body {
								font-family: Arial, sans-serif;
							}
							.container {
								max-width: 600px;
								margin: 20px auto;
								padding: 20px;
								border: 1px solid #ccc;
								border-radius: 5px;
								background-color: #ffffff;
							}
							h1 {
								text-align: center;
								margin-bottom: 20px;
							}
							label {
								font-weight: bold;
							}
							input[type="text"] {
								width: 100%;
								padding: 5px;
								margin-bottom: 10px;
							}
							button {
								background-color: #007BFF;
								color: white;
								border: none;
								padding: 10px 20px;
								cursor: pointer;
							}
							button:hover {
								background-color: #0056b3;
							}
							table {
								display: none;
								margin: 0 auto;
								width: 640px;
								margin-top: 20px;
								border-collapse: collapse;
							}
							table, th, td {
								border: 1px solid #ccc;
							}
							th, td {
								padding: 8px;
								text-align: left;
							}
						</style>
						<div class="container">
							<h1>IPv4 CIDR Calculator</h1>
							<label for="cidr4">CIDR Address:</label>
							<input type="text" id="cidr4" placeholder="Enter IPv4 CIDR Address (e.g., 192.168.1.0/24)">
							<button onclick="calculateCIDR4()">Calculate</button>
							<h2>Subnet Mask to CIDR</h2>
							<label for="subnet">Subnet Mask:</label>
							<input type="text" id="subnet" placeholder="Enter Subnet Mask (e.g., 255.255.255.0)">
							<button onclick="subnetToCIDR()">Convert</button>
							<p id="subnetResult"></p>
						</div>

							<table id="result4">
								<tr>
									<th>Network Address</th>
									<td id="network4"></td>
								</tr>
								<tr>
									<th>Start Address</th>
									<td id="start4"></td>
								</tr>
								<tr>
									<th>End Address</th>
									<td id="end4"></td>
								</tr>
								<tr>
									<th>子网掩码</th>
									<td id="subnetMask4"></td>
								</tr>
								<tr>
									<th>IP Count</th>
									<td id="ipCount4"></td>
								</tr>
							</table>

						<div class="container">
							<h1>IPv6 CIDR Calculator</h1>
							<label for="cidr">CIDR Address:</label>
							<input type="text" id="cidr" placeholder="Enter IPv6 CIDR Address (e.g., 2408:8631:2e09:102::/64)">
							<button onclick="calculateCIDR()">Calculate</button>
						</div>
						
							<table id="result">
								<tr>
									<th>Network Address</th>
									<td id="network"></td>
								</tr>
								<tr>
									<th>Start Address</th>
									<td id="start"></td>
								</tr>
								<tr>
									<th>End Address</th>
									<td id="end"></td>
								</tr>
								<tr>
									<th>IP Count</th>
									<td id="ipCount"></td>
								</tr>
							</table>

						<script>
							function calculateCIDR4() {
							const cidrInput = document.getElementById("cidr4").value;

							try {
								const [network, prefixLength] = cidrInput.split('/');
								const totalAddresses = Math.pow(2, 32 - parseInt(prefixLength));
								const subnetMaskInt = ~0 << (32 - parseInt(prefixLength));
								const networkInt = ipToInt(network) & subnetMaskInt;
								
								const startIpInt = networkInt + 1;  // Start after network address
								const endIpInt = networkInt + totalAddresses - 2;  // End before broadcast address

								document.getElementById("network4").textContent = intToIp(networkInt);
								document.getElementById("start4").textContent = intToIp(startIpInt);
								document.getElementById("end4").textContent = intToIp(endIpInt);
								document.getElementById("subnetMask4").textContent = prefixToSubnetMask(parseInt(prefixLength));
								document.getElementById("ipCount4").textContent = (totalAddresses - 2).toLocaleString();

								document.getElementById("result4").style.display = "table";
							} catch (error) {
								console.error("Invalid CIDR format for IPv4.");
							}
							}


							function ipToInt(ip) {
							return ip.split('.').map((octet) => parseInt(octet, 10)).reduce((accumulator, octet) => accumulator * 256 + octet);
							}

							function intToIp(int) {
							return [
								(int >>> 24) & 0xFF,
								(int >>> 16) & 0xFF,
								(int >>> 8) & 0xFF,
								int & 0xFF
							].join('.');
							}

							function prefixToSubnetMask(prefixLength) {
							const mask = ~0 << (32 - prefixLength);
							return intToIp(mask);
							}

							function subnetToCIDR() {
								const subnet = document.getElementById("subnet").value;
								const parts = subnet.split('.').map(Number);
								if (parts.length !== 4 || !parts.every(part => part >= 0 && part <= 255)) {
									document.getElementById("subnetResult").textContent = "Invalid subnet mask.";
									return;
								}

								const binaryString = parts.map(part => part.toString(2).padStart(8, '0')).join('');
								const cidr = binaryString.split('1').length - 1;

								document.getElementById("subnetResult").textContent = `CIDR notation: /${cidr}`;
							}

							
							function calculateCIDR() {
							const cidrInput = document.getElementById("cidr").value;
							try {
								const [inputAddress, prefixLength] = cidrInput.split('/');
								const expandedAddress = expandIPv6Address(inputAddress);
								const totalAddresses = BigInt(Math.pow(2, 128 - parseInt(prefixLength)));
								const networkBigInt = ipv6ToBigInteger(expandedAddress);

								const startIpBigInt = networkBigInt;
								const endIpBigInt = networkBigInt + totalAddresses - BigInt(1);

								document.getElementById("network").textContent = bigIntegerToIPv6(startIpBigInt);
								document.getElementById("start").textContent = bigIntegerToIPv6(startIpBigInt);
								document.getElementById("end").textContent = bigIntegerToIPv6(endIpBigInt);
								document.getElementById("ipCount").textContent = totalAddresses.toLocaleString();

								document.getElementById("result").style.display = "table";
							} catch (error) {
								console.error("Invalid CIDR format for IPv6.");
							}
						}


							function expandIPv6Address(address) {
							var fullAddress = "";
							var expandedAddress = "";
							var validGroupCount = 8;
							var validGroupSize = 4;

							var abbrev = address.split('::');

							if (abbrev.length > 2) {
								return null;
							}

							if (abbrev[0]) {
								var groups = abbrev[0].split(':');
								for(var i = 0; i < groups.length; i++) {
									while(groups[i].length < validGroupSize) {
										groups[i] = '0' + groups[i];
									}
									expandedAddress += (i !== groups.length - 1) ? groups[i] + ':' : groups[i];
								}
							}

							var postGroups = [];
							if (abbrev.length == 2 && abbrev[1]) {
								postGroups = abbrev[1].split(':');
								for(var i = 0; i < postGroups.length; i++) {
									while(postGroups[i].length < validGroupSize) {
										postGroups[i] = '0' + postGroups[i];
									}
									expandedAddress += ':' + postGroups[i];
								}
							}

							var leftGroups = validGroupCount - expandedAddress.split(':').length;
							for(var i = 0; i < leftGroups; i++) {
								expandedAddress += ':0000';
							}

							return expandedAddress;
							}



							function ipv6ToBigInteger(ip) {
							let expandedIp = expandIPv6Address(ip);
							let sections = expandedIp.split(':');
							let binStr = '';
							for (let section of sections) {
								binStr += parseInt(section, 16).toString(2).padStart(16, '0');
							}

							return BigInt('0b' + binStr);
							}

							function bigIntegerToIPv6(num) {
							let binStr = num.toString(2).padStart(128, '0');
							let ip = [];
							for (let i = 0; i < 128; i += 16) {
								ip.push(parseInt(binStr.substring(i, i + 16), 2).toString(16).padStart(4, '0'));
							}
							return ip.join(':');
							}
						</script>
					</table>
				</div>
		    </div> 
	    </div>
	</div>
<?php
//载入页脚
include_once("./template/footer.php");
?>