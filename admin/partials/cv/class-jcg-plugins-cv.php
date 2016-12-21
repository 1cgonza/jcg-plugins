<?php
  class JCGCV {
    public function __construct($category) {
      $this->content = '';
      $this->category = $category;
      $this->separator = ', ';
      $this->date_format = 'Y';

      $this->jcg_query_cv_meta();
    }

    public function jcg_query_cv_meta() {
      $args = array (
        'post_type'      => 'cv_meta',
        'cv_cat'         => $this->category,
        'posts_per_page' => -1,
        'meta_key'       => 'date_end',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC'
      );
      $cvMetaQuery = new WP_Query($args);

      if ( $cvMetaQuery->have_posts() ) {
        $this->parent_category_data = get_term_by('slug', $this->category, 'cv_cat');
        $this->content = '<h2 id="jcg-cv-section-' . $this->category . '">' . $this->parent_category_data->name . '</h2>';
        $this->content .= '<table class="jcg-cv-table"><tbody>';
          while ( $cvMetaQuery->have_posts() ) : $cvMetaQuery->the_post();
            $this->content .= $this->jcg_cv_get_item( get_the_ID() );
          endwhile; wp_reset_postdata();
        $this->content .= '</tbody></table>';
      } else {
        return '';
      }

      return $this->content;
    }

    public function jcg_cv_get_item($postID) {
      $postData = get_post_custom($postID);
      $cvItemType = '';
      $url = $postData['website_url'][0];
      $title = get_the_title();
      $currentCheck = !empty( $postData['jcg_cv_date_current'][0] ) ? $postData['jcg_cv_date_current'][0] : '0';
      $cvItemDate = $this->jcg_cv_get_date($postData['date_start'][0], $postData['date_end'][0], $currentCheck);

      $cvItemFields = [];

      if ($this->category == 'education') {
        $cvItemType = $postData['degree'][0];
      } else {
        $cvItemType = $this->jcg_cv_get_item_type($postID);
      }

      if ( $this->category == 'awards' && !empty($postData['award_title'][0]) ) {
        $cvItemFields['award_title'] = '<span class="jcg-cv-award-title">' . $postData['award_title'][0] . '</span>';
      }

      if ( !empty($title) ) {
        $wrapTitle = !empty($url) ? '<a href="' . $url . '" target="_blank">' . $title . '</a>' : $title;
        $cvItemFields['title'] = '<span class="jcg-cv-title">' . $wrapTitle . '</span>';
      }

      /*==========  DESCRIPTION  ==========*/
      $description = '';
      if ( !empty($postData['jcg_cv_item_description'][0]) ) {
        $description = '<div class="jcg-cv-item-description">' . apply_filters('the_content', $postData['jcg_cv_item_description'][0]) . '</div>';
      }

      /*==========  INSTITUTION  ==========*/
      if ( !empty($postData['institution'][0]) ) {
        $cvItemFields['institution'] = '<span class="jcg-cv-item-intitution">' . $postData['institution'][0] . '</span>';
      }

      /*==========  PLACE  ==========*/
      $city    = !empty( $postData['city'][0] )    ? $postData['city'][0]    : NULL;
      $country = !empty( $postData['country'][0] ) ? $postData['country'][0] : NULL;

      if ( strcmp($city, $country) !== 0 ) {
        $cityCheck = empty($city) ? '' : $city . $this->separator;
        $cvItemFields['place'] = '<span class="jcg-cv-item-place">' . $cityCheck . $country . '</span>';
      } else {
        $cvItemFields['place'] = '<span class="jcg-cv-item-place">' . $country . '</p>';
      }

      $educationItem = '<tr class="jcg-cv-item">';
        $educationItem .= '<td class="jcg-cv-item-col1 years">' . $cvItemDate . '</td>';
        $educationItem .= '<td class="jcg-cv-item-col2 education-info">';

          if ( !empty($cvItemType) ) {
            $educationItem .= '<span class="jcg-cv-item-type">' . $cvItemType . '</span>';
          }
          if ( !empty($cvItemFields) ) {
            $educationItem .= implode($this->separator, $cvItemFields);
          }
          if ( !empty($description) ) {
            $educationItem .= $description;
          }
        $educationItem .= '</td>'; // end .jcg-cv-item-col2
      $educationItem .= '</tr>'; // end .jcg-cv-item

      return $educationItem;
    }

    public function jcg_cv_get_item_type($postID) {
      $cvType    = '';
      $childrens = [];
      $postTerms = get_the_terms($postID, 'cv_cat');

      foreach ($postTerms as $term) {
        if ( term_is_ancestor_of($this->parent_category_data->term_id, $term->term_id, 'cv_cat') ) {
          $childrens[] = '<span class="jcg-cv-item-type jcg-cv-item-type-' . $this->category . ' jcg-cv-item-type-' . $this->category . '-' . $term->slug . '">' . $term->name . '</span>';
        }
      }

      if ( !empty($childrens) ) {
        $cvType = implode('- ', $childrens);
      }

      return $cvType;
    }

    public function jcg_cv_get_date($dateStart, $dateEnd, $currentCheck) {
      $date = '';
      if ( !empty($dateStart) ) {
        $startUNIX = strtotime($dateStart);
        $startYear = date_i18n($this->date_format, $startUNIX);
        $datesRange = $startYear;

        if ($currentCheck == '1') {
          $datesRange .= ' - ' . 'Currently';
        }
        elseif ( !empty($dateEnd) ) {
          $endUNIX = strtotime($dateEnd);
          $endYear = date_i18n($this->date_format, $endUNIX);

          if ( strcmp($startYear, $endYear) ) {
            $datesRange .= ' - ' . $endYear;
          }
        }

        $date = $datesRange;
      }

      return $date;
    }
  }