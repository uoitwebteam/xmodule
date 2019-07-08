<?php

namespace XModule\Shared;

const DEFAULT_SEARCH_OPTIONS_OPTIONS = [
  'truncateResults' => true,
];

class SearchOptions extends Element
{
  private $truncateResults;

  public function __construct(array $options = DEFAULT_SEARCH_OPTIONS_OPTIONS)
  {
    if (isset($options['truncateResults'])) {
      $this->setTruncateResults($options['truncateResults']);
    }
  }

  public function setTruncateResults(bool $truncateResults)
  {
    $this->truncateResults = $truncateResults;
  }

  public function render()
  {
    $render = [];
    if (isset($this->truncateResults)) {
      $render['truncateResults'] = $this->truncateResults;
    }
    return $render;
  }
}
