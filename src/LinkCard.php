<?php

/**
 * 链接卡片生成器
 * 
 * 根据提供的链接和关键词信息，生成结构化的HTML卡片片段。
 * 所有输出内容均经过HTML转义，确保安全显示。
 */

class LinkCard
{
    /**
     * 默认链接地址
     */
    private string $defaultUrl;

    /**
     * 默认关键词
     */
    private string $defaultKeyword;

    /**
     * 卡片样式配置
     */
    private array $styleConfig;

    /**
     * 构造函数
     * 
     * @param string $url 默认链接地址
     * @param string $keyword 默认关键词
     * @param array $style 样式配置项
     */
    public function __construct(
        string $url = 'https://zhcn-portal-1xbet.com',
        string $keyword = '1xbet',
        array $style = []
    ) {
        $this->defaultUrl = $url;
        $this->defaultKeyword = $keyword;
        $this->styleConfig = array_merge([
            'borderColor' => '#e0e0e0',
            'backgroundColor' => '#ffffff',
            'textColor' => '#333333',
            'linkColor' => '#1a73e8',
            'hoverBorderColor' => '#4285f4',
        ], $style);
    }

    /**
     * 生成链接卡片HTML
     * 
     * @param array $data 卡片数据，包含url和keyword
     * @return string 转义后的HTML片段
     */
    public function render(array $data = []): string
    {
        $url = $data['url'] ?? $this->defaultUrl;
        $keyword = $data['keyword'] ?? $this->defaultKeyword;

        $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedBorderColor = htmlspecialchars($this->styleConfig['borderColor'], ENT_QUOTES, 'UTF-8');
        $escapedBgColor = htmlspecialchars($this->styleConfig['backgroundColor'], ENT_QUOTES, 'UTF-8');
        $escapedTextColor = htmlspecialchars($this->styleConfig['textColor'], ENT_QUOTES, 'UTF-8');
        $escapedLinkColor = htmlspecialchars($this->styleConfig['linkColor'], ENT_QUOTES, 'UTF-8');
        $escapedHoverBorderColor = htmlspecialchars($this->styleConfig['hoverBorderColor'], ENT_QUOTES, 'UTF-8');

        $html = <<<HTML
<div class="link-card" style="border:1px solid {$escapedBorderColor};border-radius:8px;padding:16px;margin:12px 0;background-color:{$escapedBgColor};transition:border-color 0.3s ease;" onmouseover="this.style.borderColor='{$escapedHoverBorderColor}'" onmouseout="this.style.borderColor='{$escapedBorderColor}'">
    <div class="link-card-content" style="display:flex;flex-direction:column;gap:8px;">
        <div class="link-card-keyword" style="font-size:14px;color:{$escapedTextColor};font-weight:600;">
            &#x1F517; 关键词：{$escapedKeyword}
        </div>
        <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" style="color:{$escapedLinkColor};text-decoration:none;font-size:16px;word-break:break-all;">
            {$escapedUrl}
        </a>
        <div class="link-card-description" style="font-size:13px;color:{$escapedTextColor};opacity:0.8;margin-top:4px;">
            点击上方链接访问相关资源页面。此卡片由系统自动生成，信息仅供参考。
        </div>
    </div>
</div>
HTML;

        return $html;
    }

    /**
     * 批量生成卡片HTML
     * 
     * @param array $items 卡片数据数组，每个元素包含url和keyword
     * @return string 拼接后的HTML片段
     */
    public function renderMultiple(array $items): string
    {
        $output = '';
        foreach ($items as $item) {
            $output .= $this->render($item);
        }
        return $output;
    }

    /**
     * 获取默认配置的示例卡片
     * 
     * @return string 示例HTML
     */
    public function getExample(): string
    {
        return $this->render([
            'url' => $this->defaultUrl,
            'keyword' => $this->defaultKeyword,
        ]);
    }
}

// 使用示例（可移除）
/*
$card = new LinkCard();
echo $card->getExample();

$customCard = new LinkCard('https://example.com', 'example', [
    'borderColor' => '#ff6600',
    'backgroundColor' => '#fff8e1',
    'textColor' => '#663300',
    'linkColor' => '#ff6600',
    'hoverBorderColor' => '#ff3300',
]);
echo $customCard->render(['url' => 'https://zhcn-portal-1xbet.com', 'keyword' => '1xbet']);
*/