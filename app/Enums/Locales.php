<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum Locales: string
{
    use EnumHasValues;

    case English = 'en_US';
    case Korean = 'ko_KR';
    case Chinese = 'zh_CN';
    case Japanese = 'ja_JP';

    public function handbookKeys(): array
    {
        return match ($this) {
            self::Chinese => [
                'basic_info' => '基础档案',
                'physical_exam' => '综合体检测试',
                'profile' => '客观履历',
                'clinical_analysis' => '临床诊断分析',
                'archives' => [
                    '档案资料一',
                    '档案资料二',
                    '档案资料三',
                    '档案资料四',
                ],
                'class_conversion_record' => [
                    '升变档案一',
                    '升变档案二',
                ],
                'promotion_record' => '晋升记录',
                'performance_review' => '综合性能检测结果',
            ],
            self::English => [
                'basic_info' => 'Basic Info',
                'physical_exam' => 'Physical Exam',
                'profile' => 'Profile',
                'clinical_analysis' => 'Clinical Analysis',
                'archives' => [
                    'Archive File 1',
                    'Archive File 2',
                    'Archive File 3',
                    'Archive File 4',
                ],
                'class_conversion_record' => [
                    'Class Conversion Record 1',
                    'Class Conversion Record 2',
                ],
                'promotion_record' => 'Promotion Record',
                'performance_review' => 'Performance Review',
            ],
            self::Japanese => [
                'basic_info' => '基礎情報',
                'physical_exam' => '能力測定',
                'profile' => '個人履歴',
                'clinical_analysis' => '健康診断',
                'archives' => [
                    '第一資料',
                    '第二資料',
                    '第三資料',
                    '第四資料',
                ],
                'class_conversion_record' => [
                    '昇格資料一',
                    '昇格資料二',
                ],
                'promotion_record' => '昇進記録',
                'performance_review' => '総合性能',
            ],
            self::Korean => [
                'basic_info' => '기본정보',
                'physical_exam' => '종합검진',
                'profile' => '프로필',
                'clinical_analysis' => '임상 진단 분석',
                'archives' => [
                    '파일 자료 1',
                    '파일 자료 2',
                    '파일 자료 3',
                    '파일 자료 4',
                ],
                'class_conversion_record' => [
                    '프로모션 파일 자료 1',
                    '프로모션 파일 자료 2',
                ],
                'promotion_record' => '승진 기록',
                'performance_review' => '종합 성능 테스트 결과',
            ],
        };
    }
}
