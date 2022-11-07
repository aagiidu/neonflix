<ul class="nav navbar-nav">
				<!-- MOVIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Кино <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php
							$genres		=	$this->crud_model->get_genres();
							foreach ($genres as $row):
							?>
						<li><a href="<?php echo base_url();?>index.php?browse/movie/<?php echo $row['genre_id'];?>">
							<?php echo $row['name'];?>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
				</li>
				<!-- TV SERIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Олон ангит <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php
							$genres		=	$this->crud_model->get_genres();
							foreach ($genres as $row):
							?>
						<li><a href="<?php echo base_url();?>index.php?browse/series/<?php echo $row['genre_id'];?>">
							<?php echo $row['name'];?>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
				</li>
				<!-- TV SERIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Анимэ <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						<?php
							$genres		=	$this->crud_model->get_genres();
							foreach ($genres as $row):
							?>
						<li><a href="<?php echo base_url();?>index.php?browse/animes/<?php echo $row['genre_id'];?>">
							<?php echo $row['name'];?>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
				</li>
				<!-- MY LIST -->
				<li>
					<a href="<?php echo base_url();?>index.php?browse/mylist" style="color: #9933ff; font-weight: bold;">Миний жагсаалт</a>
				</li>
			</ul>