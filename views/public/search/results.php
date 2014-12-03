<table>
    <tr>
      <td></td>
      <td>Title (Click to view article)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>Relevancy</td>
    </tr>
  <?php
     $i = 1;
     foreach ($this->hits as $hit) {
         $score = $hit->score;
         $feedTitle = $hit->feedname;
         $channelTitle = $hit->articletitle;
         $url = $hit->url;

         $title = $feedTitle;
         if($channelTitle != '')
             $title = "$title > $channelTitle";
         echo "<tr><td>#" . $i++ . ":</td>";
         echo "<td><a href=\"$url\">$title</a></td>";
         echo "<td>$score</td></tr>";
     }
  ?>
  </table>