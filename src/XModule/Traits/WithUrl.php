<?php
namespace XModule\Traits;

trait WithUrl
{
  private $url;

  public function initUrl(array $options)
  {
    if (isset($options['url'])) {
      $this->setUrl($options['url']);
    }
  }

  public function setUrl(string $url)
  {
    $this->url = $url;
  }

  public function renderUrl(&$render)
  {
    if (isset($this->url)) {
      $render['url'] = $this->url;
    }
  }
}
