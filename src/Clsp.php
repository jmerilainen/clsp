<?php

namespace Jmerilainen\Clsp;

class Clsp
{
    public function __construct(
        protected string $defaults = '',
        protected array $variants = [],
        protected array $compoundVariants = [],
        protected array $props = [],
    ) {
    }

    public static function make(string $defaults = ''): static
    {
        return new static($defaults);
    }

    public function defaults(string $data = ''): self
    {
        $this->defaults = $data;

        return $this;
    }

    public function variants(array $data = []): self
    {
        $this->variants = $data;

        return $this;
    }

    public function compoundVariants(array $data = []): self
    {
        $this->compoundVariants = $data;

        return $this;
    }

    public function props(array $data = []): self
    {
        $this->props = $data;

        return $this;
    }

    public function generate(): string
    {
        $props = $this->props;
        $variants = $this->variants;
        $compoundVariants = $this->compoundVariants;

        $variantsClasses = collect($props)
            ->map(function ($value, $key) use ($variants) {
                if ($value === true) {
                    $value = 'default';
                }

                return $variants[$key][$value] ?? null;
            })
            ->filter()
            ->values()
            ->toArray();

        $compoundVariantsClasses = collect($compoundVariants)
            ->filter(function ($item) use ($props) {
                if (! is_array($item)) {
                    return;
                }

                return collect($item[0])
                    ->filter(function ($value, $key) use ($props) {
                        return $value !== $props[$key];
                    })->isEmpty();
            })->map(function ($item) {
                return $item[1];
            })
            ->filter()
            ->values()
            ->toArray();

        $all = collect([$this->defaults])
            ->push($variantsClasses)
            ->push($compoundVariantsClasses)
            ->flatten()
            ->filter()
            ->join(' ');

        return empty($all) ? '' : trim($all);
    }

    public function get()
    {
        return $this->generate();
    }

    public function __toString()
    {
        return $this->get();
    }
}
