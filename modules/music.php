<?
if (!isAdmin()) {
echo '<audio autoplay loop id="musicplayer">
      <source src="/media/music/city.mp3">
  </audio';

echo '<audio autoplay id="papereffect">
      <source src="/media/sfx/paper.mp3">
  </audio';
}

?>