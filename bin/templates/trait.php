<?php
namespace XModule\Traits;

trait With<%= classname %>
{
  private $<%= name %>;

  public function init<%= classname %>(array $options)
  {
    if (isset($options['<%= name %>'])) {
      $this->set<%= classname %>($options['<%= name %>']);
    }
  }

  public function set<%= classname %>(string $<%= name %>)
  {
    $this-><%= name %> = $<%= name %>;
  }

  public function render<%= classname %>(&$render)
  {
    if (isset($this-><%= name %>)) {
      $render['<%= name %>'] = $this-><%= name %>;
    }
  }
}
