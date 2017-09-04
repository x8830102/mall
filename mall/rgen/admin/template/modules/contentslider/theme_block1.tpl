<h3 class="rgen-hd-1">Content block 1</h3>
<rgen-box label="Main wrapper" config="{fonts:0, align:1}" buttonlabel="Edit" data-ng-model="themeData[manage_tab].ctn_block1.setting.main"></rgen-box>

<rgen-box label="Title" ng-if="manage_tab == 'd'" config="{f_size:1, align:1, color:1}" buttonlabel="Edit" data-ng-model="themeData[manage_tab].ctn_block1.setting.hd"></rgen-box>
<rgen-box label="Title" ng-if="manage_tab != 'd'" config="{fonts:0, f_size:1, align:1, color:1}" buttonlabel="Edit" data-ng-model="themeData[manage_tab].ctn_block1.setting.hd"></rgen-box>

<rgen-box label="Info" ng-if="manage_tab == 'd'" config="{f_size:1, align:1, color:1}" buttonlabel="Edit" data-ng-model="themeData[manage_tab].ctn_block1.setting.info"></rgen-box>
<rgen-box label="Info" ng-if="manage_tab != 'd'" config="{fonts:0, f_size:1, align:1, color:1}" buttonlabel="Edit" data-ng-model="themeData[manage_tab].ctn_block1.setting.info"></rgen-box>